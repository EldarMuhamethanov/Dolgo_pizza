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

    public function addOrder(string $pizza, string $cost, string $user, string $address, string $status): void
    {
        $order = new Orders();
        $order->setPizza($pizza)
              ->setCost($cost)
              ->setUser($user)
              ->setAddress($address)
              ->setStatus($status);
        $this->repository->add($order);
    }
}