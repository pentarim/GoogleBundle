<?php

namespace Bundle\GoogleBundle\Helper;

use Symfony\Components\Templating\Helper\Helper,
	Bundle\GoogleBundle\Adwords;

class AdwordsHelper extends Helper {

	protected $adwords;

	public function __construct(Adwords $adwords) {
		$this->adwords = $adwords;
	}

	public function getHasConversion() {
		return $this->adwords->getHasConversion();
	}

	public function getName() {
		return 'google_adwords';
	}
}
