<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use MyFunctions\MyFunctions;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu")
     */
    public function index()
    {
        $orders = [];
        $orders = MyFunctions::get_orders($orders);
        $menu = [];
        $menu = MyFunctions::get_menu($menu);
        return $this->render('menu/menu.html.twig', [
        	'orders' => $orders,
        	'menu' => $menu,
        ]);
    }
}
