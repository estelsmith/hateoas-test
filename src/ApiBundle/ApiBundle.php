<?php

namespace ApiBundle;

use ApiBundle\DependencyInjection\CompilerPass\MinerProviderCompilerPass;
use ApiBundle\DependencyInjection\CompilerPass\NavigatorFactoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApiBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new NavigatorFactoryCompilerPass());
        $container->addCompilerPass(new MinerProviderCompilerPass());
    }
}
