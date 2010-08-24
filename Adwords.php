<?php

namespace Bundle\GoogleBundle;

class Adwords {

	private $user;

	public function __construct($u) {
		$this->user = $u;
	}

	public function getHasConversion() {
		return FALSE;
	}	

	public function setConversion($id, $label, $value = 0) {
		
	}

}
