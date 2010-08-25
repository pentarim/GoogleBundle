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

	public function getRequestUri() {
		return $this->analytics->getRequestUri();
	}

	public function setWithoutBaseUrl($b = TRUE) {
		return $this->analytics->setWithoutBaseUrl($b);
	}

	public function hasCustomVars() {
		return $this->analytics->hasCustomVars();
	}

	public function getCustomVars() {
		return $this->analytics->getCustomVars();
	}

	public function hasCustomPageView() {
		return $this->analytics->hasCustomPageView();
	}

	public function getCustomPageView() {
		return $this->analytics->getCustomPageView();
	}

	public function hasPageViewQueue() {
		return $this->analytics->hasPageViewQueue();
	}

	public function getPageViewQueue() {
		return $this->analytics->getPageViewQueue();
	}

	public function getName() {
		return 'google_analytics';
	}
}
