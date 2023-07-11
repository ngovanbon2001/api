<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryReponsitoryInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Supports\RespondResource;

class CategoryService implements CategoryServiceInterface
{

    use RespondResource;

    protected $categoryReponsitoryInterface;

    public function __construct(CategoryReponsitoryInterface $repositoryInterface)
    {
        return $this->categoryReponsitoryInterface = $repositoryInterface;
    }

    public function list(array $attributes)
    {
        return $this->categoryReponsitoryInterface->list($attributes);
    }

    public function create(array $attributes)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = "no-image.png";
        }

        return $this->categoryReponsitoryInterface->create($attributes);
    }

    
    public function update(array $attributes, int $id)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = $attributes['imageOld'];
        }
        
        return $this->categoryReponsitoryInterface->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->categoryReponsitoryInterface->where("id", "=", $id)->delete();
    }

    public function detail(int $id)
    {
        return $this->categoryReponsitoryInterface->find($id);
    }
}
