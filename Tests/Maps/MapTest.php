<?php

namespace Bundle\GoogleBundle\Tests\Maps;

use Bundle\GoogleBundle\Maps\Map;
use Bundle\GoogleBundle\Maps\Marker;

class MapTest extends \PHPUnit_Framework_TestCase {

	protected $map;

	public function setUp() {
		parent::setup();
		$this->map = new Map();
	}

	public function tearDown() {
		$this->map = null;
		parent::tearDown();
	}

	public function testConstructor() {
		$this->assertFalse($this->map->hasMarkers());
	}

	public function testSetGetMarkers() {
		$marker = new Marker();
		$this->assertFalse($this->map->hasMarker($marker));
		$this->map->addMarker($marker);
		$this->assertTrue($this->map->hasMarker($marker));
		$this->map->removeMarker($marker);
		$this->assertFalse($this->map->hasMarker($marker));
	}

}
