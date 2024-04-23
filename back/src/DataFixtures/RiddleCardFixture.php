<?php

namespace App\DataFixtures;

use App\Entity\RiddleCard;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RiddleCardFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $fixtureDatas = [
            0 => [
                "name" => "Anthony Kiedis",
                "description" => "Chanteur du célèbre groupe Red Hot Chili Pepper",
                "picture" => ""
            ],
            1 => [
                "name" => "Bruce willis",
                "description" => "Acteur très célèbre qui a entre autre joué dans la série de films \"Die hard\"",
                "picture" => ""
            ],
            2 => [
                "name" => "Anne-sophie lapix",
                "description" => "Célèbre présentatrice sur le journal de France 2 qui a aussi présenté C a vous sur France 5",
                "picture" => ""
            ]
        ];

        for ($i=0; $i < 3; $i++) { 
            $riddle = (new RiddleCard())
            ->setName($fixtureDatas[$i]["name"])
            ->setDescription($fixtureDatas[$i]["description"])
            ->setPicture($fixtureDatas[$i]["picture"]);

            $manager->persist($riddle);
        }

        $manager->flush();
    }
}