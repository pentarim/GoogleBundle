<?php

namespace Bundle\GoogleBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

class Analytics {

	const CUSTOM_PAGE_VIEW_KEY = 'google_analytics/page_view';
	const PAGE_VIEW_QUEUE_KEY  = 'google_analytics/page_view/queue';
	const FUNNEL_GOAL_KEY      = 'google_analytics/funnel_goal';

	private $container;
	private $request;
	private $session;
	private $trackers;
	private $withoutBaseUrl = TRUE;
	private $customPageView;
	private $customVars = array();

	public function __construct(ContainerInterface $c, Request $r, Session $s, array $t = array()) {
		$this->container = $c;
		$this->request = $r;
		$this->session = $s;
		$this->trackers = $t;
		$this->bootServices();
	}

	public function getTrackers(array $t = array()) {
		if (!empty($t)) {
			$trackers = array();
			foreach ($t as $key) {
				if (isset($this->trackers[$key])) {
					$trackers[$key] = $this->trackers[$key];
				}
			}
			return $trackers;
		} else {
			return $this->trackers;
		}
	}

	public function getRequest() {
		return $this->request;
	}

	public function getContainer() {
		return $this->container;
	}

	public function setWithoutBaseUrl($b) {
		$this->withoutBaseUrl = $b;
	}

	public function getRequestUri() {
		$requestUri = $this->request->getRequestUri();
		if ($this->withoutBaseUrl) {
			$baseUrl = $this->request->getBaseUrl();
			if ($baseUrl != '/') {
				return str_replace($baseUrl, '', $requestUri);
			}
			return $requestUri;
		}
		return $requestUri;
	}

	public function hasCustomVars() {
		if (!empty($this->customVars)) {
			return TRUE;
		}
		return FALSE;
	}

	public function addCustomVar($index, $name, $value, $optScope = 1) {
		$customVar = new \stdClass();
		$customVar->index = $index;
		$customVar->name = $name;
		$customVar->value = $value;
		$customVar->optScope = $optScope;
		$this->customVars[] = $customVar;
	}

	public function getCustomVars() {
		return $this->customVars;
	}

	public function hasCustomPageView() {
		if (!isset($this->customPageView)) {
			return FALSE;
		}
		if (trim($this->customPageView) == '') {
			return FALSE;
		}
		return TRUE;
	}

	public function setCustomPageView($pageView) {
		$this->session()->set(self::CUSTOM_PAGE_VIEW_KEY, $pageView);		
	}

	public function getCustomPageView() {
		return $this->customPageView;
	}

	public function bootServices() {

		if ($this->getContainer()->has('session')) {
			$sess = $this->getContainer()->get('session');
			$pageView = $sess->get(self::CUSTOM_PAGE_VIEW_KEY);
			$sess->remove(self::CUSTOM_PAGE_VIEW_KEY);
			if (isset($pageView) && trim($pageView) != '' ) {
				$this->customPageView = $pageView;
			}
		}

	}

	public function addPageViewQueue($page) {
		$this->add(self::PAGE_VIEW_QUEUE_KEY, $page);
	}

	public function getPageViewQueue() {
		return $this->get(self::PAGE_VIEW_QUEUE_KEY);
	}

	public function hasPageViewQueue() {
		return $this->has(self::PAGE_VIEW_QUEUE_KEY);
	}

	protected function add($key, $message) {
		$bucket = $this->session->get($key, array());
		$bucket[] = $message;
		$this->session->set($key, $bucket);
	}

	protected function has($key) {
		$bucket = $this->session->get($key, array());
		return !empty($bucket);
	}

	protected function get($key) {
		$value = $this->session->get($key, array());
		$this->session->remove($key);
		return $value;
	}

}