<?php

namespace ApiBundle\Hateoas\Metadata\Resource;

use GoIntegro\Hateoas\Metadata\Entity\MetadataCache;
use GoIntegro\Hateoas\Metadata\Resource\MetadataMinerInterface;
use GoIntegro\Hateoas\Metadata\Resource\MinerProvider as BaseMinerProvider;

/**
 * @TODO: Oh god, I hate non-extendable bundles. >=(
 */
class MinerProvider extends BaseMinerProvider
{
    /**
     * @var array
     */
    private static $miners = [];
    /**
     * @var MetadataCache
     */
    private $metadataCache;
    /**
     * @var string
     */
    private $resourceClassPath;

    /**
     * @param MetadataCache $metadataCache
     * @param string $resourceClassPath
     */
    public function __construct(
        MetadataCache $metadataCache, $resourceClassPath
    )
    {
        $this->metadataCache = $metadataCache;
        $this->resourceClassPath = $resourceClassPath;
    }

    /**
     * @param \GoIntegro\Hateoas\JsonApi\ResourceEntityInterface|string
     * @return MetadataMinerInterface
     */
    public function getMiner($ore)
    {
        $oreClass = $this->metadataCache->getReflection($ore);
        $oreClassName = $oreClass->getName();

        if (empty(self::$miners[$oreClassName])) {
            self::$miners[$oreClassName] = $this->createMiner($oreClass);
        }

        return self::$miners[$oreClassName];
    }

    /**
     * @param \ReflectionClass $oreClass
     * @return MetadataMinerInterface
     * @throws \InvalidArgumentException
     */
    private function createMiner(\ReflectionClass $oreClass)
    {
        $factory = new MinerFactory(
            $this->metadataCache, $this->resourceClassPath, $oreClass
        );

        return $factory->create();
    }
}
