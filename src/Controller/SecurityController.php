<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 *
 *
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class SecurityController extends AbstractController
{
    /**
     * This method is used to login a user
     *
     * @param AuthenticationUtils $utils
     * @return Response
     */
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();

        return $this->render('pages/security/login.html.twig', [
            'error' => $error,
            'last_username' => $utils->getLastUsername()
        ]);
    }

    /**
     * This method is used to logout a user
     *
     * @return void
     */
    #[Route('/deconnexion', name: 'security.logout', methods: ['GET', 'POST'])]
    public function logout(): void
    {
         // Nothing to do here...
    }
}