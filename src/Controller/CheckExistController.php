<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CheckExistController extends AbstractController
{
    private $service;
    public function __construct($service)
    {
        $this->service = $service;     
    }

    /**
     * @Route("/checkExist", name="checkExist")
     */
    public function checkExist()
    {
        
    }
}