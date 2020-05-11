<?php

namespace App\Controller;

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
    public function __construct($menuService, $orderService, Security $security)
    {
        $this->menuService = $menuService;
        $this->orderService = $orderService;
        $this->security = $security;
    }
    /**
     * @Route("/get_orders", name="get_orders")
     */
    public function index()
    {
        $id = $_POST['id'];
        $pizza = $this->menuService->findById($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user === 'anon.')
        {
            return new Response(json_encode(['isAuth'=>0]));
        }
        else
        {
            $this->orderService->addOrder($pizza->getTitlePizza(), $pizza->getCost(), $user->getName(), $user->getAddress(), 'Готовится');
            return new Response(json_encode(['isAuth'=>1]));
        }  
    }
}