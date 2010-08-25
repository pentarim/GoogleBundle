<?php

namespace Bundle\GoogleBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension,
	Symfony\Component\DependencyInjection\Loader\XmlFileLoader,
	Symfony\Component\DependencyInjection\ContainerBuilder;

class GoogleExtension extends Extension {

	protected $resources = array(
        'google' => 'google.xml',
    );
		
	public function analyticsLoad($config, ContainerBuilder $container) {
		if (!$container->hasDefinition('google')) {
			$loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
			$loader->load($this->resources['google']);
		}
		if (isset($config['trackers'])) {
           $container->setParameter('google.analytics.trackers', $config['trackers']);
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
        return __DIR__.'/../Resources/config/';
    }
}
