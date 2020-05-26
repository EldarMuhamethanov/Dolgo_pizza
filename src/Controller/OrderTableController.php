<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderTableController extends AbstractController
{
    private $security;
    private $orderService;
    private $menuService;

    public function __construct($menuService, $orderService, $security)
    {
        $this->menuService = $menuService;
        $this->orderService = $orderService;
        $this->security = $security;
    }
    /**
     * @Route("/order/table", name="order_table")
     */
    public function index()
    {
        $user = $this->security->getUser();
        $id_orders = [];
        if ($this->security->IsGranted('IS_AUTHENTICATED_FULLY')) {
            $userEmail = $user->getEmail();
            $allOrders = $this->orderService->getAllOrders();
            foreach ($allOrders as $key => $value) {
                if ($userEmail === $value->getUserEmail()) {
                    $id_orders[$value->getId()] = true;
                }
            }
        }
        $orders = $this->orderService->getAllOrders();
        return $this->render('order_table/index.html.twig', [
            'orderIdArray' => $id_orders,
            'orders' => $orders
        ]);
    }
}
