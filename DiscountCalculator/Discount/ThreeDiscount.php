<?php

include_once "DiscountAbstract.php";

class FourDiscount extends DiscountAbstract
{
    protected $_name = 'Four';

    protected $_discountPercent = 10;

	private $_needleProuctCount = 4;

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