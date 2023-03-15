<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post\Comment;
use App\Repository\UserRepository;
use App\Repository\Post\PostRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

/**
 * Class CommentFixtures
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * The constructor.
     *
     * @param PostRepository $postRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly UserRepository $userRepository
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $users = $this->userRepository->findAll();
        $posts = $this->postRepository->findAll();

        foreach ($posts as $post) {
            for ($i = 0; $i < mt_rand(0, 15); $i++) {
                $comment = new Comment();
                $comment->setContent($faker->realText())
                    ->setIsApprouved(!(mt_rand(0, 3) === 0))
                    ->setAuthor($users[mt_rand(0, count($users) - 1)])
                    ->setPost($post);

                $manager->persist($comment);
                $post->addComment($comment);
            }
        }

        $manager->flush();
    }

    /**
     * The order in which fixtures will be loaded.
     *
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            PostFixtures::class
        ];
    }
}
