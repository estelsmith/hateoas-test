<?php

namespace ApiBundle\Hateoas\Metadata\Resource;

use GoIntegro\Hateoas\Metadata\Entity\MetadataCache;
use GoIntegro\Hateoas\Metadata\Resource\GhostMetadataMiner;
use GoIntegro\Hateoas\Metadata\Resource\MetadataMiner;
use GoIntegro\Hateoas\Metadata\Resource\MetadataMinerInterface;
use GoIntegro\Hateoas\Metadata\Resource\MinerFactory as BaseMinerFactory;

/**
 * @TODO: Yay, non-extendable bundle class! *copy/paste*
 */
class MinerFactory extends BaseMinerFactory
{
    const ERROR_RESOURCE_ENTITY_EXPECTED = 'Se esperaba una entidad o fantasma de recurso.';

    /**
     * @var MetadataCache
     */
    private $metadataCache;
    /**
     * @var string
     */
    private $resourceClassPath;
    /**
     * @var \ReflectionClass
     */
    private $oreClass;

    /**
     * @param MetadataCache $metadataCache
     * @param string $resourceClassPath
     * @param \ReflectionClass $oreClass
     */
    public function __construct(
        MetadataCache $metadataCache,
        $resourceClassPath,
        \ReflectionClass $oreClass
    )
    {
        $this->metadataCache = $metadataCache;
        $this->resourceClassPath = $resourceClassPath;
        $this->oreClass = $oreClass;
    }

    /**
     * @return MetadataMinerInterface
     * @throws \InvalidArgumentException
     */
    public function create()
    {
        if ($this->oreClass->implementsInterface(
            MetadataMiner::GHOST_ENTITY_INTERFACE
        )) {
            $miner = new GhostMetadataMiner($this->metadataCache);
        } elseif ($this->oreClass->implementsInterface(
            MetadataMiner::RESOURCE_ENTITY_INTERFACE
        )) {
            $miner = new EntityMetadataMiner(
                $this->metadataCache, $this->resourceClassPath
            );
        } else {
            throw new \InvalidArgumentException(
                self::ERROR_RESOURCE_ENTITY_EXPECTED
            );
        }

        return $miner;
    }

}
