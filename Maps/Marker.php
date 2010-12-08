<?php

namespace Bundle\GoogleBundle\Maps;

class Marker {

	protected $latitude;
	protected $longitude;

	public function setLatitude($latitude) {
		$this->latitude = (float) $latitude;
	}

	public function getLatitude() {
		return $this->latitude;
	}

	public function setLongitude($longitude) {
		$this->longitude = (float) $longitude;
	}

	public function getLongitude() {
		return $this->longitude;
	}

}
