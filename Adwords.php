<?php

namespace Bundle\GoogleBundle;

class Adwords {

	private $user;
	private $originatorOptions;
	private $conversion;
	private $conversionPages;

	public function __construct($user, $originatorOptions, array $conversionPages = array()) {
		$this->user = $user;
		$this->originatorOptions = $originatorOptions;
		$this->conversionPages = $conversionPages;
	}

	public function setConversionByPage($page) {
		if (isset($this->conversionPages[$page])) {
			$conversion = $this->conversionPages[$page];
			$this->setConversion($conversion['id'], $conversion['label'], $conversion['value']);
		} 
	}	

	public function getConversion() {
		if ($conversion = $this->user->getAttributeOnce('originator/google/adwords/conversion')) {
			$this->conversion = $conversion;
		}
		return $this->conversion;
	}

	public function setConversion($id, $label, $value = 0) {
		if ($this->user->getAttribute('originator/google/adwords/conversion')) {
			return;
		}
		$conversion 		= new \stdClass();
		$conversion->id 	= $id;
		$conversion->label 	= $label;
		$conversion->value 	= $value;
		$this->user->setAttribute('originator/google/adwords/conversion', $conversion);
	}

	public function removeConversion($id) {
		if (!$this->user->getAttribute('originator/google/adwords/conversion')) {
			return;
		}
		$this->user->removeAttribute('originator/google/adwords/conversion');
	}


	public function getConversionId() {
		if (!$this->getConversion()) {
			return;
		}		
		return $this->getConversion()->id;
	}

	public function getConversionLabel() {
		if (!$this->getConversion()) {
			return;
		}		
		return $this->getConversion()->label;
	}

	public function getConversionValue() {
		if (!$this->getConversion()) {
			return;
		}		
		return $this->getConversion()->value;
	}

}
