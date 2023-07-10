<?php

namespace App\Services;

use App\Constants\Constants;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{
    const paginateFe = 10;
    const paginateBe = 5;

    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        return $this->orderRepository = $orderRepositoryInterface;
    }

    public function list(array $attributes)
    {
        return $this->orderRepository->findWhere($attributes);
    }

    public function create(array $attributes)
    {
        return $this->orderRepository->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        return $this->orderRepository->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->orderRepository->where("id", "=", $id)->delete();
    }

    public function detail(int $id)
    {
        return $this->orderRepository->find($id);
    }
}