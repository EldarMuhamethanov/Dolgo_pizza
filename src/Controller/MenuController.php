<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{
    private $orderService;
    private $menuService;

    public function __construct($orderService, $menuService)
    {
        $this->orderService = $orderService;    
        $this->menuService = $menuService;
    }
    /**
     * @Route("/", name="menu")
     */
    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        $menu = $this->menuService->getAllPointOfMenu();

        return $this->render('menu/menu.html.twig', [
            'orders' => $orders,
            'menu' => $menu,
        ]);
    }

    /**
     * @Route("/update/menu", name="update_menu")
     */
    public function updateMenu()
    {
        $idField = $_POST['id'];
        $newTitle = $_POST['new_title'];
        $newDescription = $_POST['new_description'];
        $newCost = $_POST['new_cost'];
        $newPic = $_POST['new_pic'];
        $pizza = $this->menuService->findById($idField);
        $pizza->getTitlePizza() !== $newTitle ? $this->menuService->updateField($pizza, 'title', $newTitle) : null;
        $pizza->getDescription() !== $newDescription ? $this->menuService->updateField($pizza, 'description', $newDescription) : null;        
        if ((int)$newCost <= 2000)
        {
            $this->menuService->updateField($pizza, 'cost', $newCost);
        }
        if (file_exists('img/' . $newPic . '.jpg'))
        {
            $pizza->getImage() !== $newPic ? $this->menuService->updateField($pizza, 'picture', $newPic) : null;           
            return new Response(json_encode(['wrong_pic' => false]));
        }
        else
        {
            return new Response(json_encode(['wrong_pic' => true]));
        }   
    }
}
