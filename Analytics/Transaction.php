<?php

namespace Bundle\GoogleBundle\Analytics;

class Transaction {

	protected $affiliation;
	protected $country;
	protected $orderNumber;
	protected $shipping;
	protected $state;
	protected $tax;
	protected $total;

	public function setAffiliation($affiliation) {
		$this->affiliation = (string) $affiliation;
	}

	public function getAffiliation() {
		return $this->affiliation;
	}

	public function setCountry($country) {
		$this->country = (string) $country;
	}

	public function getCountry() {
		return $this->country;
	}

	public function setOrderNumber($orderNumber) {
		$this->orderNumber = (string) $orderNumber;
	}

	public function getOrderNumber() {
		return $this->orderNumber;
	}

	public function setShipping($shipping) {
		$this->shipping = (float) $shipping;
	}

	public function getShipping() {
		return $this->shipping;
	}

	public function setState($state) {
		$this->state = (string) $state;
	}

	public function getState() {
		return $this->state;
	}

	public function setTax($tax) {
		$this->tax = (float) $tax;
	}

	public function getTax() {
		return $this->tax;
	}

	public function setTotal($total) {
		$this->total = (float) $total;
	}

	public function getTotal() {
		return $this->total;
	}

}
