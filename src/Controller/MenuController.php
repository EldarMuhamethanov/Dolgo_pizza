<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use MyFunctions\Menu;
use MyFunctions\Orders;

class MenuController extends AbstractController
{
    public function index()
    {
        $orders = [];
        $orders = Orders::get_orders($orders);
        $menu = [];
        $menu = Menu::get_menu($menu);
        return $this->render('menu/menu.html.twig', [
        	'orders' => $orders,
        	'menu' => $menu,
        ]);
    }
}
