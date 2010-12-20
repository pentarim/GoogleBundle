<?php

namespace Bundle\GoogleBundle\Maps;

abstract class AbstractMap implements MapInterface {

	const TYPE_HYBRID   = 'hybrid';
	const TYPE_ROADMAP  = 'roadmap';
	const TYPE_SATELITE = 'satelite';
	const TYPE_TERRAIN  = 'terrain';

	protected $id;
	protected $markers = array();
	protected $meta = array();
	protected $sensor = false;

	static protected $typeChoices = array(
        self::TYPE_HYBRID   => 'Hybrid Map',
		self::TYPE_ROADMAP  => 'Road Map',
        self::TYPE_SATELITE => 'Satelite Map',
        self::TYPE_TERRAIN  => 'Terrain Map',
	);

	static public function getTypeChoices() {
		return self::$typeChoices;
	}

	static public function isTypeValid($type) {
		return array_key_exists($type, static::$typeChoices);
	}

	public function setId($id) {
		$this->id = (string) $id;
	}

	public function getId() {
		return $this->id;
	}

	public function hasMarkers() {
		if (!empty($this->markers)) {
			return true;
		}
		return false;
	}

	public function hasMarker(Marker $marker) {
		if ($this->markers instanceof \Doctrine\Common\Collections\Collection) {
			return $this->markers->contains($marker);
		} else {
			return in_array($marker, $this->markers, true);
		}
	}

	public function addMarker(Marker $marker) {
		$this->markers[] = $marker;
	}

	public function removeMarker(Marker $marker) {
		if (!$this->hasMarker($marker)) {
			return null;
		}
		if ($this->markers instanceof \Doctrine\Common\Collections\Collection) {
			return $this->markers->removeElement($marker);
		} else {
			unset($this->markers[array_search($marker, $this->markers, true)]);
			return $marker;
		}
	}

	public function setMarkers($markers) {
		$this->markers = $markers;
	}

	public function getMarkers() {
		return $this->markers;
	}

	public function hasMeta() {
		return !empty($this->meta);
	}

	public function setMeta(array $meta = array()) {
		$this->meta = $meta;
	}

	public function getMeta() {
		return $this->meta;
	}

	public function setSensor($sensor) {
		$this->sensor = (bool) $sensor;
	}

	public function getSensor() {
		return $this->sensor;
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

}
