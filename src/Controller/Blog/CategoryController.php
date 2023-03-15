<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Entity\Post\Category;
use App\Repository\Post\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @author Tresor-Ilunga <ilungat82@gmail.com>
 */
class CategoryController extends AbstractController
{
    /**
     * This method is used to display all posts of a category
     *
     * @param Category $category
     * @param PostRepository $postRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/categories/{slug}', name: 'category.index', methods: ['GET'])]
    public function index(Category $category, PostRepository $postRepository, Request $request): Response
    {
        $posts = $postRepository->findPublished($request->query->getInt('page', 1));

       return $this->render('pages/category/index.html.twig', [
           'category' => $category,
           'posts' => $posts,
       ]);
    }
}
