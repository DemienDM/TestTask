<?php

class Product
{
	private $_availableProducts = [
			'A' => [
				'name'  => 'A',
				'price' => 10,
			],
			'B' => [
				'name'  => 'B',
				'price' => 15,
			],
			'C' => [
				'name'  => 'C',
				'price' => 20,
			],
			'D' => [
				'name'  => 'D',
				'price' => 25,
			],
			'E' => [
				'name'  => 'E',
				'price' => 30,
			],
			'F' => [
				'name'  => 'F',
				'price' => 35,
			],
			'G' => [
				'name'  => 'G',
				'price' => 40,
			],
			'H' => [
				'name'  => 'H',
				'price' => 45,
			],
			'I' => [
				'name'  => 'I',
				'price' => 50,
			],
			'J' => [
				'name'  => 'J',
				'price' => 55,
			],
			'K' => [
				'name'  => 'K',
				'price' => 60,
			],
			'L' => [
				'name'  => 'L',
				'price' => 65,
			],
			'M' => [
				'name'  => 'M',
				'price' => 70,
			]
		];

	/**
	*
	*/
	public function getDetailedOrder(array $orderProducts) {

		if ($orderProducts === array()) {
			throw new Exception("Order have no products");
		}

		foreach ($orderProducts as $productName) {			
			if (!$this->_validateProducts($productName)) {
				throw new Exception("Product is not available");
			}
			$detailedOrder[] = $this->_availableProducts[$productName];
		}

		return $detailedOrder;
	} 

	private function _validateProducts($productName) {
		if (isset($this->_availableProducts[$productName])) {
			return true; 
		}
		return false;
	}
}