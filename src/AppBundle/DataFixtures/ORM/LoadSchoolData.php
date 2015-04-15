<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\School;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSchoolData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $schoolNames = [
            'School 1',
            'School 2'
        ];

        foreach ($schoolNames as $schoolName) {
            $school = (new School())->setName($schoolName);

            $manager->persist($school);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 0;
    }
}
