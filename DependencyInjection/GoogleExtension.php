<?php

namespace Bundle\GoogleBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GoogleExtension extends Extension {

	protected $resources = array(
		'google_adwords'   => 'adwords.xml',
		'google_analytics' => 'analytics.xml',
		'google_maps'      => 'maps.xml',
	);

	public function adwordsLoad($config, ContainerBuilder $container) {
		if (!$container->hasDefinition('google.adwords')) {
			$loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
			$loader->load($this->resources['google_adwords']);
		}
		if (isset($config['originator'])) {
			$container->setParameter('google.adwords.originator', $config['originator']);
		}
		if (isset($config['conversions'])) {
			$container->setParameter('google.adwords.conversions', $config['conversions']);
		}
		return $container;
	}

	public function analyticsLoad($config, ContainerBuilder $container) {
		if (!$container->hasDefinition('google.analytics')) {
			$loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
			$loader->load($this->resources['google_analytics']);
		}
		if (isset($config['trackers'])) {
			$container->setParameter('google.analytics.trackers', $config['trackers']);
		}
		return $container;
	}

	public function mapsLoad($config, ContainerBuilder $container) {
		if (!$container->hasDefinition('google.maps')) {
			$loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
			$loader->load($this->resources['google_maps']);
		}
		if (isset($config['config'])) {
			$container->setParameter('google.maps.config', $config['config']);
		}
		return $container;
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
		return __DIR__.'/../Resources/config/schema';
	}
}
