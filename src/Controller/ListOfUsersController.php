<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Users\UsersUtils;
use App\Entity\User;

class ListOfUsersController extends AbstractController
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }
    
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // or add an optional message - seen by developers
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $users = $this->service->getAllUsers();
        return $this->render('list_of_users/index.html.twig', [
            'users' => $users,
        ]);
    }
}
