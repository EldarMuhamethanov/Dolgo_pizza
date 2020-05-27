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

    public function updateField(PizzaMenu $pizza, string $nameOfField, string $value)
    {
        if ($nameOfField === 'title')
        {
            $pizza->setTitlePizza($value);
        }
        if ($nameOfField === 'description')
        {
            $pizza->setDescription($value);
        }
        if ($nameOfField === 'cost')
        {
            $pizza->setCost($value);
        }
        if ($nameOfField === 'picture')
        {
            $pizza->setImage($value);
        }
        $this->repository->update();
    }
}