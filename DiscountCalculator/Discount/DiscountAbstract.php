<?php

abstract class DiscountAbstract
{
    protected $_name;

    protected $_discountPercent;

    abstract public function searchCase(array $productList);

    protected function _searchProduct($productName, $orderProductList)
    {
        foreach ($orderProductList as $key => $product) {
            if ($productName == $product['name']) {
                return $key;
            }
        }

        return false;
    }

    protected function _calculateDiscountValue(array $productIds, array $productList)
    {
        $sum = 0;
        foreach ($productIds as $productId) {
            $sum += $productList[$productId]['price'];
        }

        return Helper::calculateDiscount($sum, $this->_discountPercent);
    }
}