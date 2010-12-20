<?php

namespace Bundle\GoogleBundle\Maps;

class StaticMap extends AbstractMap {

	const API_ENDPOINT = 'http://maps.google.com/maps/api/staticmap?';

	protected $height;
	protected $width;

	public function setCenter($center) {
		$this->meta['center'] = (string) $center;
	}

	public function getCenter() {
		if (array_key_exists('center', $this->meta)) {
			return $this->meta['center'];
		}
	}

	public function setHeight($height) {
		$this->height = (int) $height;
	}

	public function getHeight() {
		return $this->height;
	}

	public function setSize($size) {
		$arr = explode('x', $size);
		if (isset($arr[0])) {
			$this->width = $arr[0];
		}
		if (isset($arr[1])) {
			$this->height = $arr[1];
		}
		$this->meta['size'] = (string) $size;
	}

	public function getSize() {
		if (($height = $this->getHeight()) && ($width = $this->getWidth())) {
			$this->meta['size']  = $width;
			$this->meta['size'] .= 'x';
			$this->meta['size'] .= $height;
		}
		if (array_key_exists('size', $this->meta)) {
			return $this->meta['size'];
		}
	}

	public function setWidth($width) {
		$this->width = (int) $width;
	}

	public function getWidth() {
		return $this->width;
	}

	public function setZoom($zoom) {
		$this->meta['zoom'] = (int) $zoom;
	}

	public function getZoom() {
		if (array_key_exists('zoom', $this->meta)) {
			return $this->meta['zoom'];
		}
	}

	public function render() {
		$request  = static::API_ENDPOINT;
		if ($this->hasMeta()) {
			foreach ($this->getMeta() as $key => $val) {
				$request .= $key.'='.$val.'&';
			}
		}
		if ($this->getSensor()) {
			$request .= 'sensor=true&';
		} else {
			$request .= 'sensor=false&';
		}
		if ($this->hasMarkers()) {
			foreach ($this->getMarkers() as $marker) {
				$request .= 'markers=';
				if ($marker->hasMeta()) {
					foreach ($marker->getMeta() as $mkey => $mval) {
						$request .= $mkey.':'.$mval.'|';
					}
				}
				if ($latitude = $marker->getLatitude()) {
					$request .= $latitude;
				}
				if ($longitude = $marker->getLongitude()) {
					$request .= ','.$longitude;
				}
			}	
		}
		$request = rtrim($request, "& ");
		$out = '<img id="'.$this->getId().'" src="'.$request.'" />';
		return $out;
	}

}
