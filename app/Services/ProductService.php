<?php

namespace App\Services;

use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    protected $productReponsitory;

    /**
     * @param ProductReponsitoryInterface $repositoryInterface
     */
    public function __construct(ProductReponsitoryInterface $repositoryInterface)
    {
        return $this->productReponsitory = $repositoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        return $this->productReponsitory->list($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = "no-image.png";
        }

        return $this->productReponsitory->create($attributes);
    }


    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = $attributes['oldImage'];
        }

        return $this->productReponsitory->update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->productReponsitory->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->productReponsitory->find($id);
    }
}
