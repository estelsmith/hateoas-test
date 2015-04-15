<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $schoolRespository = $manager->getRepository('AppBundle:School');

        $users = [
            [
                'username' => 'test1',
                'password' => 'test1',
                'school' => 'School 1'
            ],
            [
                'username' => 'test2',
                'password' => 'test2',
                'school' => 'School 1'
            ],
            [
                'username' => 'test3',
                'password' => 'test3',
                'school' => 'School 2'
            ]
        ];

        foreach ($users as $userData) {
            $user = (new User())
                ->setUsername($userData['username'])
                ->setPassword($userData['password'])
                ->setSchool(
                    $schoolRespository->findOneBy([
                        'name' => $userData['school']
                    ])
                )
            ;

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
