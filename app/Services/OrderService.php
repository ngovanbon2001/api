<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{
    protected $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepositoryInterface
     */
    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        return $this->orderRepository = $orderRepositoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        return $this->orderRepository->list($attributes)->toArray();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->orderRepository->create($attributes)->toArray();
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        return $this->orderRepository->update($attributes, $id)->toArray();
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->orderRepository->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->orderRepository->find($id)->toArray();
    }
}
