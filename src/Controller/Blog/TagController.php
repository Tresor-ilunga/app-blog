<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Entity\Post\Tag;
use App\Repository\Post\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TagController
 *
 *
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
#[Route('/etiquettes')]
class TagController extends AbstractController
{
    /**
     * The tag index page
     *
     * @param Tag $tag
     * @param PostRepository $postRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/{slug}', name: 'tag.index', methods: ['GET'])]
    public function index(Tag $tag, PostRepository $postRepository, Request $request): Response
    {
        $posts = $postRepository->findPublished($request->query->getInt('page', 1), null, $tag);

        return $this->render('pages/tag/index.html.twig', [
            'tag' => $tag,
            'posts' => $posts
        ]);
    }
}