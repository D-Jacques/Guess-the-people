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
            ],
            3 => [
                "name" => "Christopher Nolan",
                "description" => "Homme du cinéma, il a réalisé entre autres les films batman, the dark knight et the dark knight rises",
                "picture" => ""
            ],
            4 => [
                "name" => "Barack Obama",
                "description" => "Ancient président, il avait fait campagne avec son célèbre slogan \"Yes We Can\" ",
                "picture" => ""
            ],
            5 => [
                "name" => "Thomas Pesquet",
                "description" => "Spationaute Français, il a été envoyé dans l'espace dans le cadre de la mission proxima",
                "picture" => ""
            ],
            6 => [
                "name" => "Bill Gates",
                "description" => "Grand informaticien, il est cofondateur de Microsoft",
                "picture" => ""
            ],
            7 => [
                "name" => "Hugo Décrypte",
                "description" => "Jeune youtubeur, il réalise de courtes vidéos expliquant l'actualité à destination des jeunes",
                "picture" => ""
            ],
            8 => [
                "name" => "Lionnel Messi",
                "description" => "Grand joueur Argentin, il est célèbre mondialement dans le milieu du football",
                "picture" => ""
            ],
            9 => [
                "name" => "Linus Torvald",
                "description" => "Informaticien d'origine finlandaise, il est le créateur de Linux et de git",
                "picture" => ""
            ],
        ];

        for ($i=0; $i < count($fixtureDatas); $i++) { 
            $riddle = (new RiddleCard())
            ->setName($fixtureDatas[$i]["name"])
            ->setDescription($fixtureDatas[$i]["description"]);

            $manager->persist($riddle);
        }

        $manager->flush();
    }
}