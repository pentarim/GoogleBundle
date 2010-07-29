<?php

namespace Bundle\GoogleBundle\Helper;

use Symfony\Components\Templating\Helper\Helper,
	Bundle\GoogleBundle\Analytics;

class AnalyticsHelper extends Helper {

	protected $analytics;

	public function __construct(Analytics $analytics) {
		$this->analytics = $analytics;
	}

	public function getTrackers(array $t = array()) {
		return $this->analytics->getTrackers($t);
	}
	
	public function getRequest() {
		return $this->analytics->getRequest();
	}

	public function getRequestUri($withoutBaseUrl = TRUE) {
		return $this->analytics->getRequestUri($withoutBaseUrl);
	}

	public function getName() {
		return 'google_analytics';
	}
}
