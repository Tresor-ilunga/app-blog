<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Entity\Post\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommentController
 * @author Tresor-ilunga <19im065@esisalama.org>
 */
class CommentController extends AbstractController
{
    #[Route('/comment/{id}', name: 'comment.delete', methods: ['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === comment.getAuthor()")]
    public function delete(Comment $comment, EntityManagerInterface $em, Request $request): Response
    {
        $params = ['slug' => $comment->getPost()->getSlug()];
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token')))
        {
            $em->remove($comment);
            $em->flush();
            $this->addFlash('success', 'Commentaire supprimé avec succès');
        }

        return $this->redirectToRoute('post.show');
    }
}