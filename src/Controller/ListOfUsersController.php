<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ListOfUsersController extends AbstractController
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }
    /**
     * @Route("/users", name="users")
     */
    public function index()
    {
        $users = $this->service->getAllUsers();
        return $this->render('list_of_users/index.html.twig', [
            'users' => $users,
        ]);
    }
}
