<?php

namespace Bundle\GoogleBundle\Maps;

class Map {

	protected $id;
	protected $markers = array();

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

}
