<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //PHONES
        for ($i = 0; $i < 20; $i++) {
            $phone = new Phone;

            $phone->setBrand("Brand" . $i);
            $phone->setColour("Colour" . $i);
            $phone->setDescription("This is the description of Mobile Phone " . $i);
            $phone->setHeight(mt_rand(11, 15));
            $phone->setWidth(mt_rand(5, 9));
            $phone->setName("MobilePhone" . $i);
            $phone->setPrice(mt_rand(50, 1500));
            $phone->setWeight(mt_rand(100, 300));

            $manager->persist($phone);
        }
        
        $manager->flush();
    }
}
