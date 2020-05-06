<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\PizzaMenu;
use App\Entity\Orders;

class GetOrdersController extends AbstractController
{
    /**
     * @Route("/get_orders", name="get_orders")
     */
    public function index()
    {
        $pizzaList = $this->getDoctrine()->getRepository(PizzaMenu::class);
        $id = $_POST['id'];
        $pizza = $pizzaList->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $order = new Orders();
        $order->setPizza($pizza->getTitlePizza());
        $order->setCost($pizza->getCost());
        $order->setUser('АНОНИМ');
        $order->setAddress('АНОНИМ');
        $order->setStatus('ready');
        $entityManager->persist($order);
        $entityManager->flush();
        return new Response(json_encode(['success' => 1]));
    }
}