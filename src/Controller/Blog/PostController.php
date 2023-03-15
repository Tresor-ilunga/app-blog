<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Entity\Post\Comment;
use App\Entity\Post\Post;
use App\Form\CommentType;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\Post\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class PostController extends AbstractController
{
    /**
     * This method is used to display all posts
     *
     * @param PostRepository $postRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/', name: 'post.index', methods: ['GET', 'POST'])]
    public function index(PostRepository $postRepository, Request $request): Response
    {
        $searchData  = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $searchData->page = $request->query->getInt('page', 1);
            $posts = $postRepository->findBySearch($searchData);

            return $this->render('pages/post/index.html.twig', [
                'form' => $form->createView(),
                'posts' => $posts
            ]);
        }

        return $this->render('pages/post/index.html.twig', [
            'form' => $form->createView(),
            'posts' => $postRepository->findPublished( $request->query->getInt('page', 1))
        ]);
    }

    /**
     * This method is used to display a post
     *
     * @param Post $post
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/article/{slug}', name: 'post.show', methods: ['GET', 'POST'])]
    public function show(Post $post, Request $request, EntityManagerInterface $manager): Response
    {
        $comment = new Comment();
        $comment->setPost($post);
        if ($this->getUser())
        {
            $comment->setAuthor($this->getUser());
        }

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash
            ('success',
                'Votre commentaire a été enregistré. Il ser soumis à moderation dans les plus brefs délais.'
            );

            return $this->redirectToRoute('post.show', ['slug' => $post->getSlug()]);
        }

        return $this->render('pages/post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }
}
