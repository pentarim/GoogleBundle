<?php

namespace Bundle\GoogleBundle;

use Symfony\Components\HttpKernel\Request;

class Analytics {

	private $_request;
	private $_trackers;	

	public function __construct(Request $r, array $t = array()) {
		$this->_request = $r;
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

	public function getRequest() {
		return $this->_request;
	}

	public function getRequestUri($withoutBaseUrl = TRUE) {
		if ($withoutBaseUrl) {
			$requestUri = $this->_request->getRequestUri();
			$baseUrl = $this->_request->getBaseUrl();
			return str_replace($baseUrl, '', $requestUri);
		}
		return $this->_request->getRequestUri();
	}

}
