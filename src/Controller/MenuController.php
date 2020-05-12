<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    private $orderService;
    private $menuService;

    public function __construct($orderService, $menuService)
    {
        $this->orderService = $orderService;    
        $this->menuService = $menuService;
    }
    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        $menu = $this->menuService->getAllPointOfMenu();

        return $this->render('menu/menu.html.twig', [
            'orders' => $orders,
            'menu' => $menu,
        ]);
    }
}
