<?php

namespace ApiBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NavigatorFactoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $factoryDefinition = $container->getDefinition('hateoas.raml.navigator_factory');
        $factoryDefinition->setClass('ApiBundle\Factory\RamlNavigatorFactory');
    }
}
