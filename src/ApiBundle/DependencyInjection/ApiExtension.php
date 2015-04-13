<?php

namespace ApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ApiExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $container->setParameter('api.base_url', 'http://localhost');
        $container->setParameter('api.url_path', '/api/v1');
        $container->setParameter('api.resource_class_path', 'Hateoas/Resource');
    }
}
