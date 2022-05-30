<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Post;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {

        for ($u = 1; $u <= 14; $u++){
            $user = new User();
            $user->setEmail('user'. $u .'@email.com');
            $user->setUsername('user' . $u);

            $password = $this->passwordHasher->hashPassword($user, 'user'. $u);
            $user->setPassword($password);
            $manager->persist($user);
        }



        for ($i = 1; $i <= 10; $i++) {
            $Post = new Post();
            $Post->setTitle("test n'". $i ."");
            $Post->setPicture('Image');
            $Post->setFile('Video');
            $Post->setLikes('45');
            $Post->setShare('2');
            $Post->setPostedAt(new \DateTimeImmutable());
            $manager->persist($Post);

        }



        $manager->flush();
    }
}
