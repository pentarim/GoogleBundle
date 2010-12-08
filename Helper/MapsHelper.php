<?php

namespace Bundle\GoogleBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Bundle\GoogleBundle\MapsManager;

class MapsHelper extends Helper {

	protected $manager;

	public function __construct(MapsManager $manager) {
		$this->manager = $manager;
	}

	public function getKey() {
		return $this->manager->getKey();
	}

	public function getMaps() {
		return $this->manager->getMaps();
	}

	public function getMapById($id) {
		return $this->manager->getMapById($id);
	}

	public function getName() {
		return 'google_maps';
	}
}

