<?php

include_once "DiscountAbstract.php";

class EFGDiscount extends DiscountAbstract
{
    protected $_name = 'EFG';

    protected $_discountPercent = 5;

    private $_needleProuctNames = ['E', 'F', 'G'];

    function searchCase(array $orderProductList)
    {
        foreach ($this->_needleProuctNames as $productName) {
            $productId = $this->_searchProduct($productName, $orderProductList);
            if ($productId === false) {
                return array();
            }

            $discountData['usedProductIds'][] = $productId;
        }

        $discountData['name']                  = $this->_name;
        $discountData['discountValue']         = $this->_calculateDiscountValue($discountData['usedProductIds'], $orderProductList);
        $discountData['discountPercent']       = $this->_discountPercent;
        $discountData['discountCheckComplete'] = count($orderProductList) < 5;

        return $discountData;
    }
}