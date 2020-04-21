<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use MyFunctions\Users;

class ListOfUsersController extends AbstractController
{
    /**
     * @Route("/users", name="list_of_users")
     */
    public function index()
    {
        $users = Users::get_users();

        return $this->render('list_of_users/index.html.twig', [
            'users' => $users,
        ]);
    }
}
