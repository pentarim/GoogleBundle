<?php

namespace Bundle\GoogleBundle;

class Analytics {

	private $_trackers;

	public function __construct(array $t = array()) {
		$this->_trackers = $t;
	}

	public function getTrackers(array $t = array()) {
		if (!empty($t)) {
			$trackers = array();
			foreach ($t as $key) {
				if (isset($this->_trackers[$key])) {
					$trackers[$key] = $this->_trackers[$key];
				}
			}
			return $trackers;
		} else {
			return $this->_trackers;
		}
	}	

}
