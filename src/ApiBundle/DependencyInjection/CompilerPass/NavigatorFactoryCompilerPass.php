<?php

namespace ApiBundle\DependencyInjection\CompilerPass;

use ApiBundle\Factory\RamlNavigatorFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NavigatorFactoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $factoryDefinition = $container->getDefinition('hateoas.raml.navigator_factory');
        $factoryDefinition->setClass(RamlNavigatorFactory::class);
    }
}
