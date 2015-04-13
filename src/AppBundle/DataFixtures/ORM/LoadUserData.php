<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $users = [
            [
                'username' => 'test1',
                'password' => 'test1',
                'salt' => 'test123'
            ],
            [
                'username' => 'test2',
                'password' => 'test2',
                'salt' => 'test123'
            ],
            [
                'username' => 'test3',
                'password' => 'test3',
                'salt' => 'test123'
            ]
        ];

        foreach ($users as $userData) {
            $user = (new User())
                ->setUsername($userData['username'])
                ->setPassword($userData['password'])
                ->setSalt($userData['salt'])
            ;

            $manager->persist($user);
        }

        $manager->flush();
    }
}
