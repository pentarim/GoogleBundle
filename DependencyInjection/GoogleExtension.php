<?php

namespace Bundle\GoogleBundle\DependencyInjection;

use Symfony\Components\DependencyInjection\Loader\LoaderExtension,
		Symfony\Components\DependencyInjection\Loader\XmlFileLoader,
		Symfony\Components\DependencyInjection\BuilderConfiguration;

class GoogleExtension extends LoaderExtension {

	protected $resources = array(
		'google_adwords'   => 'adwords.xml',
		'google_analytics' => 'analytics.xml',
	);

	public function analyticsLoad($config, BuilderConfiguration $configuration) {
		if (!$configuration->hasDefinition('google.analytics')) {
			$loader = new XmlFileLoader(__DIR__.'/../Resources/config');
			$configuration->merge($loader->load($this->resources['google_analytics']));
		}
		if (isset($config['trackers'])) {
			$configuration->setParameter('google.analytics.trackers', $config['trackers']);
		}
		return $configuration;
	}

	public function adwordsLoad($config, BuilderConfiguration $configuration) {
		if (!$configuration->hasDefinition('google.adwords')) {
			$loader = new XmlFileLoader(__DIR__.'/../Resources/config');
			$configuration->merge($loader->load($this->resources['google_adwords']));
		}
		if (isset($config['originator'])) {
			$configuration->setParameter('google.adwords.originator', $config['originator']);
		}
		if (isset($config['conversions'])) {
			$configuration->setParameter('google.adwords.conversions', $config['conversions']);
		}
		return $configuration;
	}

	/**
	 * Returns the recommended alias to use in XML.
	 *
	 * This alias is also the mandatory prefix to use when using YAML.
	 *
	 * @return string The alias
	 */
	public function getAlias() {
		return 'google';
	}

	/**
	 * Returns the namespace to be used for this extension (XML namespace).
	 *
	 * @return string The XML namespace
	 */
	public function getNamespace() {
		return 'http://www.symfony-project.org/schema/dic/google';
	}

	/**
	 * Returns the base path for the XSD files.
	 *
	 * @return string The XSD base path
	 */
	public function getXsdValidationBasePath() {
		return __DIR__.'/../Resources/config/';
	}
}
