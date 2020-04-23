<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Menu\Menu;
use Orders\Orders;

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
