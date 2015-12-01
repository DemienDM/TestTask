<?php

include_once "DiscountAbstract.php";

class DEDiscount extends DiscountAbstract
{
    protected $_name = 'DE';

    protected $_discountPercent = 5;

	private $_needleProuctNames = ['D', 'E'];

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