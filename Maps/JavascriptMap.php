<?php

namespace Bundle\GoogleBundle\Maps;

class JavascriptMap extends AbstractMap {

	const API_ENDPOINT = 'http://maps.google.com/maps/api/js?';

	public function setViewportScale($scale) {
		$this->meta['viewport_scale'] = (float) $scale;
	}

	public function getViewportScale() {
		if (array_key_exists('viewport_scale', $this->meta)) {
			return $this->meta['viewport_scale'];
		}
	}

	public function setViewportUserScalable($scalable) {
		$this->meta['viewport_user_scalable'] = (bool) $scalable;
	}

	public function getViewportUserScalable() {
		if (array_key_exists('viewport_user_scalable', $this->meta)) {
			return $this->meta['viewport_user_scalable'];
		}
	}

}
