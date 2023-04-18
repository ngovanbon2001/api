<?php

namespace App\Services;

use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Supports\RespondResource;

class ProductService implements ProductServiceInterface
{
    use RespondResource;

    protected $productReponsitory;

    public function __construct(ProductReponsitoryInterface $repositoryInterface)
    {
        return $this->productReponsitory = $repositoryInterface;
    }

    public function all()
    {
        return $this->productReponsitory->paginate($this->paginateFe);
    }

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

    public function delete(array $attributes, int $id)
    {
        return $this->productReponsitory->update($attributes, $id);
    }

    public function detail(int $id)
    {
        $conditions = [
            'id' => $id
        ];
        return $this->productReponsitory->findWhereFirst($conditions);
    }
}
