<?php

namespace Bundle\GoogleBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Bundle\GoogleBundle\MapsManager;
use Bundle\GoogleBundle\Maps\MapInterface;

class MapsHelper extends Helper {

	protected $manager;

	public function __construct(MapsManager $manager) {
		$this->manager = $manager;
	}

	public function getKey() {
		return $this->manager->getKey();
	}

	public function hasMaps() {
		return $this->manager->hasMaps();
	}

	public function getMaps() {
		return $this->manager->getMaps();
	}

	public function getMapById($id) {
		return $this->manager->getMapById($id);
	}

	public function render(MapInterface $map) {
		return $map->render();
	}

	public function getName() {
		return 'google_maps';
	}
}

