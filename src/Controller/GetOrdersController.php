<?php

namespace App\Controller;

use Menu\Menu;
use Orders\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class GetOrdersController extends AbstractController
{
    /**
     * @Route("/get_orders", name="get_orders")
     */
    public function index()
    {
        $menu = Menu::getMenu();
        {
            $file_name = 'users.json';
            $menu = Menu::getMenu();
            $id = $_POST['id'];
            $menu = Orders::setOrders($menu[$id - 1]);
            return new Response(json_encode(['success'=>1]));
        }
    }
}