<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * Class LikeController
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class LikeController extends AbstractController
{
    /**
     * This method is used to like a post
     *
     * @param Post $post
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/like/article/{id}', name: 'like.post', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function like(Post $post, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();

        if ($post->isLikedByUser($user))
        {
            $post->removeLike($user);
            $manager->flush();

            return $this->json
            (['message'  => 'Le like a bien été supprimé',
                'nbLike' => $post->howManyLikes()
            ]);
        }

        $post->addLike($user);
        $manager->flush();

        return $this->json
        ([
            'message' => 'Le like a bien été ajouté',
            'nbLike' => $post->howManyLikes()
        ]);
    }
}