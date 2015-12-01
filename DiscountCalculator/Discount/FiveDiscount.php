<?php

include_once "DiscountAbstract.php";

class FiveDiscount extends DiscountAbstract
{
    protected $_name = 'Five';

    protected $_discountPercent = 20;

	private $_needleProuctCount = 5;

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