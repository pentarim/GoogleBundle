<?php

namespace Bundle\GoogleBundle;

use Symfony\Components\DependencyInjection\ContainerInterface;
use Symfony\Components\HttpKernel\Request;
use Symfony\Framework\WebBundle\User;

class Analytics {

	const CUSTOM_PAGE_VIEW_KEY = 'google_analytics/page_view';
	const PAGE_VIEW_QUEUE_KEY  = 'google_analytics/page_view/queue';

	private $container;
	private $request;	
	private $user;
	private $trackers;	
	private $withoutBaseUrl = TRUE;
	private $customPageView;
	private $customVars = array();

	public function __construct(ContainerInterface $c, Request $r, User $u, array $t = array()) {
		$this->container = $c;		
		$this->request = $r;
		$this->user = $u;
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

	public function getCustomPageView() {
		return $this->customPageView;
	}

	public function bootServices() {

		if ($this->getContainer()->hasService('simplecas')) {
			$uid = $this->getContainer()->getCasService()->getUid();
			if (isset($uid) && trim($uid) !== '') {
				try {
					$user = $this->getContainer()->getCasService()->getUser();
					if (isset($user)) {
						$this->addCustomVar(1, 'logged', 'in', 2);						
						if ($seller = $user->getSeller()) {
							$this->addCustomVar(2, 'entity', 'seller', 2);	
						} else if ($supplier = $user->getSupplier()) {
							$this->addCustomVar(2, 'entity', 'supplier', 2);	
						} else {
							$this->addCustomVar(2, 'entity', 'customer', 2);
						}						
					} else {
						$this->addCustomVar(1, 'logged', 'out', 2);	
					}
				} catch (\Exception $e) {
					$this->addCustomVar(1, 'logged', 'out', 2);						
				}			
			} else {
				$this->addCustomVar(1, 'logged', 'out', 2);	
			}
		}

		if ($this->getContainer()->hasService('user')) {			
			$sess = $this->getContainer()->getService('user');
			$pageView = $sess->getAttributeOnce(self::CUSTOM_PAGE_VIEW_KEY);
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
		$bucket = $this->user->getAttribute($key, array());
		$bucket[] = $message;
		$this->user->setAttribute($key, $bucket);
	}

	protected function has($key) {
		$bucket = $this->user->getAttribute($key, array());
		return !empty($bucket);
	}

	protected function get($key) {
		return $this->user->getAttributeOnce($key, array());
	}

}
