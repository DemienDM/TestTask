<?php

include_once "DiscountAbstract.php";

class AKLMDiscount extends DiscountAbstract
{
    protected $_name = 'AKLM';

    protected $_discountPercent = 5;

    private $_needleProuctNames = ['firstKey' => 'A', 'secondKey' => ['K', 'L', 'M']];

    function searchCase(array $orderProductList)
    {

        $firstProductId = $this->_searchProduct($this->_needleProuctNames['firstKey'], $orderProductList);
        if ($firstProductId === false) {
            return array();
        }
        $discountData['usedProductIds'][] = $firstProductId;

        foreach ($this->_needleProuctNames['secondKey'] as $secondProductName) {
            $secondProductId = $this->_searchProduct($secondProductName, $orderProductList);
            if ($secondProductId !== false) {
                $discountData['usedProductIds'][] = $secondProductId;
                break;
            }
        }

        if (count($discountData['usedProductIds']) < 2) {
            return array();
        }

        $discountData['name']                  = $this->_name;
        $discountData['discountValue']         = $this->_calculateDiscountValue($discountData['usedProductIds'], $orderProductList);
        $discountData['discountPercent']       = $this->_discountPercent;
        $discountData['discountCheckComplete'] = count($orderProductList) < 4;

        return $discountData;
    }

}