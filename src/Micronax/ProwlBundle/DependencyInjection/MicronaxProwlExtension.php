<?php

namespace Micronax\ProwlBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * MicronaxProwlBundle Extension.
 *
 * @author Fabian Golle <me@fabian-golle.de>
 */
class MicronaxProwlExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('prowl.xml');

        $container->setParameter('prowl.debug', $config['debug']);
        $container->setParameter('prowl.providerKey', $config['provider_key']);
        $container->setParameter('prowl.appName', $config['app_name']);
        $container->setParameter('prowl.apiKey', $config['api_key']);
    }
}
