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
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = "no-image.png";
        }

        return $this->orderRepository->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = $attributes['imageOld'];
        }

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