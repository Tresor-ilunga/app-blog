<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Entity\Post\Post;
use App\Repository\Post\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @author Tresor-ilunga <19im06@esisalama.org>
 */
class PostController extends AbstractController
{
    #[Route('/', name: 'post.index', methods: ['GET'])]
    public function index(PostRepository $postRepository, Request $request): Response
    {

        return $this->render('pages/post/index.html.twig', [
            'posts' => $postRepository->findPublished( $request->query->getInt('page', 1))
        ]);
    }

    #[Route('/article/{slug}', name: 'post.show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('pages/post/show.html.twig', [
            'post' => $post
        ]);
    }
}
