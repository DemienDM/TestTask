<?php

include_once "DiscountAbstract.php";

class ThreeDiscount extends DiscountAbstract
{
    protected $_name = 'Three';

    protected $_discountPercent = 5;

	private $_needleProuctCount = 3;

	function searchCase(array $orderProductList)
	{
        $discountData = array();

        if (count($orderProductList) >= $this->_needleProuctCount) {
            $discountData['name']                  = $this->_name;
            $discountData['discountPercent']       = $this->_discountPercent;
            $discountData['commonDiscountPercent'] = $this->_discountPercent;
            $discountData['discountCheckComplete'] = true;
        }

		return $discountData;
	}
}