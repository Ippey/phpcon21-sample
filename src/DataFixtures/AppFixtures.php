<?php

namespace App\DataFixtures;

use App\Entity\Theater;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $theater = new Theater();
        $theater
            ->setName('企業1')
            ;
        $manager->persist($theater);

        $manager->flush();
    }
}
