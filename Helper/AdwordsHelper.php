<?php

namespace Bundle\GoogleBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Bundle\GoogleBundle\Analytics;

class AdwordsHelper extends Helper {

	protected $adwords;

	public function __construct(Adwords $adwords) {
		$this->adwords = $adwords;
	}

	public function getConversion() {
		return $this->adwords->getConversion();
	}

	public function getConversionId() {
		return $this->adwords->getConversionId();
	}

	public function getConversionLabel() {
		return $this->adwords->getConversionLabel();
	}

	public function getConversionValue() {
		return $this->adwords->getConversionValue();
	}

	public function getName() {
		return 'google_adwords';
	}
}
