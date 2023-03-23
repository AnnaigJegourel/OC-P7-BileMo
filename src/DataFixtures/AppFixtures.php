<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\User;
use App\Entity\Phone;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        //CUSTOMER
        $customer = new Customer;
        $customer->setName('CustomerName');
        $manager->persist($customer);

        //USERS
        for ($i = 0; $i < 5; $i++) {
            $user = new User;

            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $i.'password'));

            $user->setCustomer($customer);
            $user->setEmail('user'.$i.'@customer.com');

            $user->setFirstName('Firstname'.$i);
            $user->setLastName('Lastname'.$i);

            $manager->persist($user);    
        }

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
