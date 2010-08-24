<?php

namespace Bundle\GoogleBundle;

use Symfony\Components\DependencyInjection\ContainerInterface;
use Symfony\Components\HttpKernel\Request;

class Analytics {

	private $_container;
	private $_request;	
	private $_trackers;	
	private $_withoutBaseUrl = TRUE;
	private $_customPageView;
	private $_customVars = array();
	
	public function __construct(ContainerInterface $c, Request $r, array $t = array()) {
		$this->_container = $c;		
		$this->_request = $r;
		$this->_trackers = $t;
		$this->bootServices();
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

	public function getContainer() {
		return $this->_container;
	}

	public function setWithoutBaseUrl($b) {
		$this->_withoutBaseUrl = $b;
	}

	public function getRequestUri() {
		$requestUri = $this->_request->getRequestUri();		
		if ($this->_withoutBaseUrl) {			
			$baseUrl = $this->_request->getBaseUrl();
			if ($baseUrl != '/') {
				return str_replace($baseUrl, '', $requestUri);
			}
			return $requestUri;
		}
		return $requestUri;
	}
	
	public function hasCustomVars() {
		if (!empty($this->_customVars)) {
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
		$this->_customVars[] = $customVar;
	}

	public function getCustomVars() {
		return $this->_customVars;
	}

	public function hasCustomPageView() {
		if (!isset($this->_customPageView)) {
			return FALSE;
		}
		if (trim($this->_customPageView) == '') {
			return FALSE;
		}
		return TRUE;
	}	

	public function getCustomPageView() {
		return $this->_customPageView;
	}

	public function bootServices() {

		if ($this->getContainer()->hasService('simplecas')) {
			$uid = $this->getContainer()->getCasService()->getUid();
			if (isset($uid) && trim($uid) !== '') {
				try {
					$user = $this->getContainer()->getCasService()->getUser();
					if (isset($user)) {
						$this->addCustomVar(1, 'logged', 'in', 1);						
						if ($seller = $user->getSeller()) {
							$this->addCustomVar(2, 'entity', 'seller', 1);	
						} else if ($supplier = $user->getSupplier()) {
							$this->addCustomVar(2, 'entity', 'supplier', 1);	
						} else {
							$this->addCustomVar(2, 'entity', 'customer', 1);
						}						
					} else {
						$this->addCustomVar(1, 'logged', 'out', 1);	
					}
				} catch (\Exception $e) {
					$this->addCustomVar(1, 'logged', 'out', 1);						
				}			
			
				
			} else {
				$this->addCustomVar(1, 'logged', 'out', 1);	
			}
		}

		if ($this->getContainer()->hasService('user')) {			
			$sess = $this->getContainer()->getService('user');
			$pageView = $sess->getAttributeOnce('google_analytics/page_view');
			if (isset($pageView) && trim($pageView) != '' ) {	
				$this->_customPageView = $pageView;
			}
		}

	}

}
