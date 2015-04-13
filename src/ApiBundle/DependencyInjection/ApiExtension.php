<?php

namespace ApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ApiExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $fileLocator = new FileLocator(__DIR__.'/../Resources/config');
        $servicesLoader = new YamlFileLoader($container, $fileLocator);
        $servicesLoader->load('services.yml');

        $container->setParameter('api.base_url', 'http://localhost');
        $container->setParameter('api.url_path', '/api/v1');
        $container->setParameter('api.resource_class_path', 'Hateoas/Resource');
    }
}
