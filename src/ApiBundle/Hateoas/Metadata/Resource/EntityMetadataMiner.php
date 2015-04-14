<?php

namespace ApiBundle\Hateoas\Metadata\Resource;

use GoIntegro\Hateoas\Metadata\Entity\MetadataCache;
use GoIntegro\Hateoas\Metadata\Resource\EntityMetadataMiner as BaseEntityMetadataProvider;

/**
 * @TODO: More non-extendability. Mmmmm.
 */
class EntityMetadataMiner extends BaseEntityMetadataProvider
{
    /**
     * @var string
     */
    private $resourceClassPath;

    public function __construct(MetadataCache $metadataCache, $resourceClassPath)
    {
        parent::__construct($metadataCache, $resourceClassPath);

        $this->resourceClassPath = $resourceClassPath;
    }

    protected function entityClassToResourceClass(\ReflectionClass $class)
    {
        $path = strtr($this->resourceClassPath, '/', '\\');

        // Huehuehe, custom functionality.
        if ($this->resourceClassPath[0] === '@') {
            $className = explode('\\', $class->getName());
            $className = end($className);

            return sprintf('%s\%sResource', substr($path, 1), $className);
        } else {
            return str_replace('Entity', $path, $class->getName()) . 'Resource';
        }
    }
}
