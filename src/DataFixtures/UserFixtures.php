<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserFixtures
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class UserFixtures extends Fixture
{
    /**
     * UserFixtures constructor.
     *
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // My user
        $user = new User();
        $user->setEmail('tresor.ilunga@gmail.com')
            ->setFirstname('Tresor')
            ->setPassword($this->hasher->hashPassword($user, 'password'));

        $manager->persist($user);

        for ($i = 0; $i < 9; $i++)
        {
            $user = new User();
            $user->setEmail($faker->email())
                ->setLastname($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setPassword($this->hasher->hashPassword($user, 'password'));

            $manager->persist($user);
        }

        $manager->flush();
    }
}