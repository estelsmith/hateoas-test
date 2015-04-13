<?php

namespace ApiBundle\Factory;

use GoIntegro\Bundle\HateoasBundle\DependencyInjection\Factory\RamlNavigatorFactory as BaseNavigatorFactory;
use GoIntegro\Json\JsonCoder;
use GoIntegro\Raml;
use Symfony\Component\HttpKernel\KernelInterface;

class RamlNavigatorFactory extends BaseNavigatorFactory
{
    const RAML_DOC_PATH = '/../src/ApiBundle/Resources/config/api.raml';
    const ERROR_PARAM_TYPE = 'The "api.raml" file was not found.';

    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Raml\DocParser
     */
    private $parser;

    /**
     * @param KernelInterface $kernel
     * @param Raml\DocParser $parser
     */
    public function __construct(KernelInterface $kernel, Raml\DocParser $parser)
    {
        $this->kernel = $kernel;
        $this->parser = $parser;
    }

    /**
     * @param JsonCoder $jsonCoder
     * @return Raml\DocNavigator
     * @TODO: Remove when pull request is merged: https://github.com/GoIntegro/hateoas-bundle/pull/76
     */
    public function createNavigator(JsonCoder $jsonCoder)
    {
        $ramlDocPath = $this->kernel->getRootDir() . static::RAML_DOC_PATH;

        if (!is_readable($ramlDocPath)) {
            throw new \RuntimeException(static::ERROR_PARAM_TYPE);
        }

        $ramlDoc = $this->parser->parse($ramlDocPath);

        return new Raml\DocNavigator($ramlDoc, $jsonCoder);
    }
}
