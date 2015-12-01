<?php

include_once "DiscountAbstract.php";

class ABDiscount extends DiscountAbstract
{
    protected $_name = 'AB';

    protected $_discountPercent = 10;

	private $_needleProuctNames = ['A', 'B'];

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
		$discountData['discountCheckComplete'] = count($orderProductList) < 4;

		return $discountData;
	}
}