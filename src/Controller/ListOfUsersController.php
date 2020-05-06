<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Users\UsersUtils;
use App\Entity\User;

class ListOfUsersController extends AbstractController
{
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        return $this->render('list_of_users/index.html.twig', [
            'users' => $users,
        ]);
    }
}
