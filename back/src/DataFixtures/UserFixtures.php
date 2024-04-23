<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture{

    public function load(ObjectManager $manager)
    {
        // $fixturesDatas = [
        //     0 => [
        //         'email' => "jacques.ducroux@gmail.com",
        //         'roles' => ['ROLE_USER', 'ROLE_ADMIN'],
        //         'password' => "jacques"
        //     ]
        // ];

        // for ($i=0; $i < count($fixturesDatas) ; $i++) { 
        //     $user = (new User())
        //         ->setEmail($fixturesDatas[$i]['email'])
        //         ->setRoles($fixturesDatas[$i]['roles'])
        //         ->setPassword($fixturesDatas[$i]['password']);
        //     $manager->persist($user);
        // }

        UserFactory::createOne(['email' => "jacques.ducroux@gmail.com"]);
        UserFactory::createMany(10);

        $manager->flush();
    }
    
}