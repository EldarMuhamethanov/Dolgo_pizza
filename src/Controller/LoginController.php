<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    private $service;
    public function __construct($service)
    {
        $this->service = $service;
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $utils)
    {
        $lastEmail  = $utils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'last_username' => $lastEmail,
            'thisUserEmail' => $_GET['thisUserEmail'] ?? '',
            'thisUserPassword' => $_GET['thisUserPassword'] ?? ''
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */

    public function logout() {}
}
