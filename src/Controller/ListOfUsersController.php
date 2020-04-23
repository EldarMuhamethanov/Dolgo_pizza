<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Users\UsersUtils;

class ListOfUsersController extends AbstractController
{
    public function index()
    {
        $users = UsersUtils::getUsers();
        return $this->render('list_of_users/index.html.twig', [
            'users' => $users,
        ]);
    }
}
