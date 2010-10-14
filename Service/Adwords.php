<?php

namespace Bundle\GoogleBundle\Service;

use Symfony\Component\HttpFoundation\Session;

class Adwords {

	const CONVERSION_KEY = 'originator/google/adwords/conversion';

	private $session;
	private $originatorOptions;
	private $conversion;
	private $conversionPages;

	public function __construct(Session $session, $originatorOptions, array $conversionPages = array()) {
		$this->session = $session;
		$this->originatorOptions = $originatorOptions;
		$this->conversionPages = $conversionPages;
	}

	public function setConversionByPage($page) {
		if (array_key_exists($page,$this->conversionPages)) {
			$conversion = $this->conversionPages[$page];
			$this->setConversion($conversion['id'], $conversion['label'], $conversion['value']);
		} 
	}	

	public function hasConversion() {
		return $this->session->has(self::CONVERSION_KEY);
	}

	public function getConversion() {
		if ($this->session->has(self::CONVERSION_KEY)) {
			$this->conversion = $this->session->get(self::CONVERSION_KEY);			
			$this->session->remove(self::CONVERSION_KEY);			
		}
		return $this->conversion;
	}

	public function setConversion($id, $label, $value = 0) {
		if ($this->session->has(self::CONVERSION_KEY)) {
			return;
		}
		$conversion 		= new \stdClass();
		$conversion->id 	= $id;
		$conversion->label 	= $label;
		$conversion->value 	= $value;
		$this->session->set(self::CONVERSION_KEY, $conversion);
	}

	public function getConversionId() {
			
		return $this->getConversion()->id;
	}

	public function getConversionLabel() {
			
		return $this->getConversion()->label;
	}

	public function getConversionValue() {
			
		return $this->getConversion()->value;
	}

}
