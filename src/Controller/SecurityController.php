<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @author Tresor-ilunga <19im065@esisalama.org>
 */
class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();

        return $this->render('pages/security/login.html.twig', [
            'error' => $error,
            'last_username' => $utils->getLastUsername()
        ]);
    }

    #[Route('/deconnexion', name: 'security.logout', methods: ['GET', 'POST'])]
    public function logout(): void
    {
         // Nothing to do here...
    }
}