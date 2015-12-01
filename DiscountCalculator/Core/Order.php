<?php

include_once "Product.php";
include_once "Helper.php";
include_once "Discount/ABDiscount.php";
include_once "Discount/DEDiscount.php";
include_once "Discount/EFGDiscount.php";
include_once "Discount/AKLMDiscount.php";
include_once "Discount/FiveDiscount.php";
include_once "Discount/FourDiscount.php";
include_once "Discount/ThreeDiscount.php";

class Order
{
    private $_totalPrice = 0;

    private $_totalPriceWithDiscount = 0;

    private $_discountCheckComplete = false;

    private $_deteiledOrderProducts = array();

    private $_usedDiscountNames = array();

    private $_discountNameListSortedByPriority = [
        'AB'   => 'AB', 'DE' => 'DE', 'EFG' => 'EFG', 'AKLM' => 'AKLM',
        'Five' => 'Five', 'Four' => 'Four', 'Three' => 'Three'
    ];

    function __construct(array $productList)
    {
        $product                      = new Product();
        $this->_deteiledOrderProducts = $product->getDetailedOrder($productList);
        $this->_calculateTotalPrice();
        $this->_availableDiscounts = $this->_checkAvailableDiscounts();
    }

    private function _calculateTotalPrice()
    {
        foreach ($this->_deteiledOrderProducts as $product) {
            $this->_totalPrice += $product['price'];
        }
        $this->_totalPriceWithDiscount = $this->_totalPrice;
    }

    private function _checkAvailableDiscounts()
    {
        foreach ($this->_discountNameListSortedByPriority as $discountName) {
            $discountClassName                                      = $discountName . 'Discount';
            $this->_discountNameListSortedByPriority[$discountName] = new $discountClassName();
        }

        while (!$this->_discountCheckComplete) {
            $this->_searchAndApplyDiscount();
        }
    }

    private function _searchAndApplyDiscount()
    {
        foreach ($this->_discountNameListSortedByPriority as $discountObject) {
            $discountData = $discountObject->searchCase($this->_deteiledOrderProducts);
            if ($discountData) {
                $this->_applyDiscount($discountData);
                return;
            }

            if ($discountObject === end($this->_discountNameListSortedByPriority)) {
                $this->_discountCheckComplete = true;
            }
        }
    }

    private function _applyDiscount(array $discountData)
    {
        $this->_discountCheckComplete = $discountData['discountCheckComplete'];
        $this->_usedDiscountNames[]   = $discountData['name'];

        if (isset($discountData['commonDiscountPercent'])) {
            $this->_totalPriceWithDiscount -=
                Helper::calculateDiscount(
                    $this->_totalPrice,
                    $discountData['commonDiscountPercent']
                );
            return;
        }
        $this->_totalPriceWithDiscount -= $discountData['discountValue'];

        foreach ($discountData['usedProductIds'] as $productId) {
            unset($this->_deteiledOrderProducts[$productId]);
        }
    }

    public function displayOrderInfo()
    {
        echo "\nTotal price without discount - {$this->_totalPrice}";
        if (count($this->_usedDiscountNames)) {
            $amountDiscount = $this->_totalPrice - $this->_totalPriceWithDiscount;
            echo "\nTotal price with discount    - {$this->_totalPriceWithDiscount}";
            echo "\nAmount of discount           - {$amountDiscount}";
            echo "\nDiscount names list:";
            foreach ($this->_usedDiscountNames as $discountName) {
                echo "\n{$discountName}";
            }
        }
        echo "\n";
    }
}