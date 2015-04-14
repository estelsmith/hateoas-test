<?php

namespace ApiBundle\Security\Authorization\Voter;

use ApiBundle\Hateoas\Resource\UserResource;
use AppBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;
use GoIntegro\Hateoas\Security\VoterFilterInterface;

class UserVoterFilter extends GrantEverythingVoter implements VoterFilterInterface
{
    public function supportsClass($class)
    {
        return $class === User::class;
    }

    public function filter(QueryBuilder $qb, array $filters, $alias = 'e')
    {
        $allowedFilters = UserResource::$allowedFilters;

        // @TODO: Pull this out into a reusable service at some point.
        if (array_key_exists('custom', $filters) && is_array($filters['custom'])) {
            $customFilters = $filters['custom'];

            if (array_key_exists('filter', $customFilters) && is_array($customFilters['filter'])) {
                $filter = $customFilters['filter'];
                $parameters = [];

                foreach ($filter as $columnName => $filterValue) {
                    if (in_array($columnName, $allowedFilters, true)) {
                        $qb->andWhere($qb->expr()->like(sprintf('e.%s', $columnName), sprintf(':%s', $columnName)));
                        $parameters[$columnName] = $filterValue;
                    }
                }

                $qb->setParameters($parameters);

            }
        }

        return $qb;
    }
}
