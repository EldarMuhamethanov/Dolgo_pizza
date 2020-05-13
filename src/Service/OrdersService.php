<?php

namespace App\Service;

use App\Entity\Orders;

class OrdersService
{
    private $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAllOrders()
    {
        return $this->repository->getAll();
    }

    public function addOrder(string $pizza, string $cost, string $user, string $address, string $status, string $userEmail): void
    {
        $order = new Orders();
        $order->setPizza($pizza)
              ->setCost($cost)
              ->setUser($user)
              ->setAddress($address)
              ->setStatus($status)
              ->setUserEmail($userEmail);
        $this->repository->add($order);
    }

    public function findById(string $id)
    {
        return $this->repository->findById($id);
    }

    public function updateField(Orders $order, string $nameOfField, string $value)
    {
        if ($nameOfField === 'pizza')
        {
            $order->setPizza($value);
        }
        if ($nameOfField === 'cost')
        {
            $order->setCost($value);
        }
        if ($nameOfField === 'user')
        {
            $order->setUser($value);
        }
        if ($nameOfField === 'address')
        {
            $order->setAddress($value);
        }
        if ($nameOfField === 'status')
        {
            $order->setStatus($value);
        }
        if ($nameOfField === 'userEmail')
        {
            $order->setUserEmail($value);
        }
        $this->repository->update();
    }

}