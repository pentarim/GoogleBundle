<?php

namespace Bundle\GoogleBundle\Maps;

class StaticMap extends AbstractMap {

	const TYPE_ROADMAP = 'roadmap';

	static protected $typeChoices = array(
		self::TYPE_ROADMAP => 'Road Map',
	);

	static public function getTypeChoices() {
		return self::$typeChoices;
	}

	static public function isTypeValid($type) {
		return array_key_exists($type, static::$typeChoices);
	}

	public function setCenter($center) {
		$this->meta['center'] = (string) $center;
	}

	public function getCenter() {
		if (array_key_exists('center', $this->meta)) {
			return $this->meta['center'];
		}
	}

	public function setSensor($sensor) {
		$this->meta['sensor'] = (bool) $sensor;
	}

	public function getSensor() {
		if (array_key_exists('sensor', $this->meta)) {
			return $this->meta['sensor'];
		}
	}

	public function setSize($size) {
		$this->meta['size'] = (string) $size;
	}

	public function getSize() {
		if (array_key_exists('size', $this->meta)) {
			return $this->meta['size'];
		}
	}

	public function setType($type) {
		$type = (string) $type;
		if (FALSE === $this->isTypeValid($type)) {
			throw new \InvalidArgumentException($type.' is not a valid Static Map Type.');
		}
		$this->meta['type'] = $type;
	}

	public function getType() {
		if (array_key_exists('type', $this->meta)) {
			return $this->meta['type'];
		}
	}

	public function setZoom($zoom) {
		$this->meta['zoom'] = (int) $zoom;
	}

	public function getZoom() {
		if (array_key_exists('zoom', $this->meta)) {
			return $this->meta['zoom'];
		}
	}

}
