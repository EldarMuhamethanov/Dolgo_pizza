<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class GetOrdersController extends AbstractController
{
    /**
     * @var Security
     */
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
     * @Route("/get_orders", name="get_orders")
     */
    public function getOrder()
    {
        $id = $_POST['id'];
        $pizza = $this->menuService->findById($id);
        $user = $this->security->getUser();
        if (!($this->security->IsGranted('IS_AUTHENTICATED_FULLY'))) {
            return new Response(json_encode(['redirect_url' => 'login']));
        } else {
            $this->orderService->addOrder($pizza->getTitlePizza(), $pizza->getCost(), $user->getName(), $user->getAddress(), 'Готовится', $user->getEmail());
            return new Response(json_encode([]));
        }
    }
    /**
     * @Route("/update_status", name="update_status")
     */
    public function updateStatus()
    {
        $id = $_POST['status_id'];
        $value = $_POST['new_value'];
        $order = $this->orderService->findById($id);
        $this->orderService->updateField($order, 'status', $value);
        return new Response(json_encode(['new_value' => $value]));
    }
    /**
     * @Route("/delete/order", name="delete_order")
     */
    public function deleteOrder()
    {
        $id = $_POST['id_order'];
        $order = $this->orderService->findById($id);
        $this->orderService->deleteOrder($order);
        return new Response(json_encode([]));
    }
}