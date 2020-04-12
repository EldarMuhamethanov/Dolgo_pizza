<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu")
     */
    public function index()
    {
    	$orders = [
    		"#1" => [
    			'number' => '#1',
	        	'pizza' => 'pizza1',
	        	'cost' => '520',
	        	'user' => 'User1',
	        	'addres' => 'Address1',
	        	'status' => 'ready',
    		],
    		"#2" => [
    			'number' => '#2',
	        	'pizza' => 'pizza2',
	        	'cost' => '540',
	        	'user' => 'User2',
	        	'addres' => 'Address2',
	        	'status' => 'ready',
    		],
    	];
    	$menu = [
    		'#1' => [
    			'image' => 'pizza1',
    			'title_pizza' => 'Пожилая пицца',
    			'description' => 'Не самые свежие помидоры и мягкие огурцы без пупырышков. Про сыр вообще молчу.',
    			'cost'=> '520',
    		],
    		'#2' => [
    			'image' => 'pizza2',
    			'title_pizza' => '50 оттенков пиццы',
    			'description' => 'Ананасы и маринованая сельдь. Ты точно этого хочешь, больной?',
    			'cost'=> '420',
    		],
    		
    		'#3' => [
    			'image' => 'pizza3',
    			'title_pizza' => 'Пудель',
    			'description' => 'Нежный сыр фета и кудрявые волосы уволенного повара. А нечего было без шапочки готовить',
    			'cost'=> '530',
    		],
    		
    		'#4' => [
    			'image' => 'pizza1',
    			'title_pizza' => 'Ваня, придумай название',
    			'description' => 'У меня фантазия на исходе, а еще 3 макета рисовать',
    			'cost'=> '520',
    		],
    		'#5' => [
    			'image' => 'pizza2',
    			'title_pizza' => 'Тестовая пицца',
    			'description' => 'Вроде все работает как надо, СУПЕР!!!',
    			'cost'=> '1000',
    		]
    	];
        return $this->render('menu/menu.html.twig', [
        	'orders' => $orders,
        	'menu' => $menu,
        ]);
    }
}
