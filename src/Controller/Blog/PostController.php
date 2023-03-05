<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Repository\Post\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @author Tresor-ilunga <19im06@esisalama.org>
 */
class PostController extends AbstractController
{
    #[Route('/', name: 'post.index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findPublished();

        return $this->render('pages/blog/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
