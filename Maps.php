<?php

namespace Bundle\GoogleBundle;

class Maps {

	protected $config = array();

	public function __construct(array $config = array()) {
		$this->config = $config;
	}

	public function setKey($key) {
		$this->config['key'] = $key;
	}

	public function getKey() {
		if (array_key_exists('key', $this->config)) {
			return $this->config['key'];
		}
	}

}
