<?php

namespace ApiBundle\Hateoas\Resource;

use GoIntegro\Hateoas\JsonApi\EntityResource;

class UserResource extends EntityResource
{
    public static $fieldBlacklist = ['password', 'salt'];

    public static $allowedFilters = ['username'];
}
