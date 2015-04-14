<?php

namespace ApiBundle\DependencyInjection\CompilerPass;

use ApiBundle\Hateoas\Metadata\Resource\MinerProvider;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MinerProviderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('hateoas.miner_provider');
        $definition->setClass(MinerProvider::class);
    }
}
