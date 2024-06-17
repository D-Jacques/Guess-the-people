<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture{

    public function load(ObjectManager $manager)
    {
        UserFactory::createOne(['email' => "jacques.ducroux@gmail.com"]);
        UserFactory::createMany(10);

        $manager->flush();
    }
    
}