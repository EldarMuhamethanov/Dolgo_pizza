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
     * @Route("/update_table", name="update_table")
     */
    public function update()
    {
        $new_orders = $this->orderService->getAllOrders();
        $new_table = '
        <tr class="header">
    		<th class="number">Номер</th>
    		<th class="name_order">Меню</th>
    		<th class="price">Цена</th>
    		<th class="client">Клиент</th>
    		<th class="adress">Адрес</th>
    		<th class="status">Статус</th>
    	</tr>';
        foreach ($new_orders as $key => $value) {
            $this_order = '
            <tr class="order_row" id="order_' . $value->getId() . '"> 
                <td class="number">#' . $value->getId() . '</td>
                <td class="name_order">' . $value->getPizza() . '</td>
                <td class="price">' . $value->getCost() . '</td>
                <td class="client">' . $value->getUser() . '</td>
                <td class="address">' . $value->getAddress() . '</td>
                <td class="status">' . $value->getStatus() . '</td>
            </>';
            $new_table = $new_table . $this_order;
        }
        return new Response($new_table);
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
     * @Route("/highlight_orders", name="highlight_orders")
     */
    public function highlightOrders()
    {
        $user = $this->security->getUser();
        if ($this->security->IsGranted('IS_AUTHENTICATED_FULLY')) {
            $userEmail = $user->getEmail();
            $allOrders = $this->orderService->getAllOrders();
            $id_orders = [];
            foreach ($allOrders as $key => $value) {
                if ($userEmail === $value->getUserEmail()) {
                    array_push($id_orders, $value->getId());
                }
            }
            return new Response(json_encode(['ids' => $id_orders, 'user' => 'user']));
        }
        return new Response(json_encode(['user' => 'anon']));
    }
}