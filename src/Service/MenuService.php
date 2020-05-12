<?php

namespace App\Service;

use App\Entity\PizzaMenu;

class MenuService
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAllPointOfMenu()
    {
        return $this->repository->getAll();
    }

    public function findById(string $id)
    {
        return $this->repository->findById($id);
    }
}