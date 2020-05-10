<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class GetOrdersController extends AbstractController
{
    private $orderService;
    private $menuService;
    public function __construct($menuService, $orderService)
    {
        $this->menuService = $menuService;
        $this->orderService = $orderService;
    }
    /**
     * @Route("/get_orders", name="get_orders")
     */
    public function index()
    {
        $id = $_POST['id'];
        $pizza = $this->menuService->findById($id);
        $this->orderService->addOrder($pizza->getTitlePizza(), $pizza->getCost(), 'АНОНИМ', 'АНОНИМ', 'ready');
    }
}