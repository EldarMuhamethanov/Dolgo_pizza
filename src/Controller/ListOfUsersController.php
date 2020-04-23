<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use MyFunctions\WorkWithUsers;

class ListOfUsersController extends AbstractController
{
    public function index()
    {
        $users = WorkWithUsers::getUsers();
        return $this->render('list_of_users/index.html.twig', [
            'users' => $users,
        ]);
    }
}
