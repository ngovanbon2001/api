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

    public function all()
    {
        return $this->categoryReponsitoryInterface->paginate($this->paginateFe);
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

    public function delete(array $attributes, int $id)
    {
        return $this->categoryReponsitoryInterface->update($attributes, $id);
    }

    public function detail(int $id)
    {
        return $this->categoryReponsitoryInterface->detail($id);
    }
}