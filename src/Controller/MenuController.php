<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use MyFunctions\Menu;
use MyFunctions\Orders;

class MenuController extends AbstractController
{
    public function index()
    {
        $orders = Orders::getOrders();
        $menu = Menu::getMenu();
        return $this->render('menu/menu.html.twig', [
        	'orders' => $orders,
        	'menu' => $menu,
        ]);
    }
}
