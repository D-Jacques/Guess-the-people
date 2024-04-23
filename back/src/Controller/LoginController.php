<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

#[Route('', name: 'backoffice_login_')]
class LoginController extends AbstractController
{

    #[Route('/login', name: 'index')]
    public function index(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('login/index.html.twig', [
            // Get the login errors if there is any
            // Last username entered by the user
            'errors' => $authenticationUtils->getLastAuthenticationError(),
            'lastUser' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): void
    {
        throw new \Exception('logout() should never be reached here');
    }
}
