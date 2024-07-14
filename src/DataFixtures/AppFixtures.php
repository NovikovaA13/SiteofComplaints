<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\ComplaintFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(readonly UserPasswordHasherInterface $passwordHasher){}

    public function load(ObjectManager $manager): void
    {
        $user = new User();//On create admin
        $user->setEmail("admin@gmail.com");
        $user->setName("admin");
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();

        UserFactory::createMany(10);
        ComplaintFactory::createMany(70);
    }
}
