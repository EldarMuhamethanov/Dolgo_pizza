<?php

namespace App\Controller;

use App\Entity\PizzaMenu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Orders;

class MenuController extends AbstractController
{
    public function index()
    {
        $ordersList = $this->getDoctrine()->getRepository(Orders::class);
        $orders = $ordersList->findAll();
        $pizzaList = $this->getDoctrine()->getRepository(PizzaMenu::class);
        $menu = $pizzaList->findAll();
        return $this->render('menu/menu.html.twig', [
            'orders' => $orders,
            'menu' => $menu,
        ]);
    }
}
