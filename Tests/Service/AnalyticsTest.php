<?php

namespace Bundle\GoogleBundle\Service;

use Bundle\GoogleBundle\Service\Analytics;

class AnalyticsTest extends \PHPUnit_Framework_TestCase {

	protected $analytics;
	protected $container;	
	protected $request;
	protected $user;
	protected $config;

	public function setUp() {
		parent::setUp();
		$this->markTestIncomplete('Mocking incomplete');
		$this->request = $this->getRequestMock();
		$this->user = $this->getUserMock();		
	}

	public function tearDown() {
		parent::tearDown();
		$this->request = null;
		$this->user = null;
	}

	public function getUserMock() {
		$user = $this->getMock('Symfony\Framework\WebBundle\User', array(),
			array($this->getEventDispatcherMock(), $this->getSessionInterfaceMock()));
		$user->expects($this->once())
			->method('getFlashMessages')
			->will($this->returnValue(array()));
		return $user;
	}

	public function getRequestMock() {
		$request = $this->getMock('Symfony\Components\HttpKernel\Request');
		return $request;
	}

	public function getEventDispatcherMock() {
		$dispatcher = $this->getMock('Symfony\Components\EventDispatcher\EventDispatcher');
		return $dispatcher;
	}

	public function getSessionInterfaceMock() {
		$interface = $this->getMock('Symfony\Framework\WebBundle\Session\SessionInterface');
		return $interface;
	}

}
