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

    public function all()
    {
        return $this->orderRepository->paginate(self::paginateBe);
    }

    public function list(string $title)
    {
        return $this->orderRepository->findTitle($title);
    }

    public function create(array $attributes)
    {
        return $this->orderRepository->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        return $this->orderRepository->update($attributes, $id);
    }

    public function delete(array $attributes, int $id)
    {
        return $this->orderRepository->update($attributes, $id);
    }

    public function detail(int $id)
    {
        $conditions = [
            'id' => $id
        ];
        return $this->orderRepository->findWhereFirst($conditions);
    }

}