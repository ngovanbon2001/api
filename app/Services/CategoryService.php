<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryReponsitoryInterface;
use App\Services\Contracts\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryReponsitoryInterface;

    /**
     * @param CategoryReponsitoryInterface $repositoryInterface
     */
    public function __construct(CategoryReponsitoryInterface $repositoryInterface)
    {
        return $this->categoryReponsitoryInterface = $repositoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        return $this->categoryReponsitoryInterface->list($attributes)->toArray();
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

        return $this->categoryReponsitoryInterface->create($attributes)->toArray();
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
            $attributes['image_url'] = $attributes['imageOld'];
        }

        return $this->categoryReponsitoryInterface->update($attributes, $id)->toArray();
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->categoryReponsitoryInterface->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->categoryReponsitoryInterface->find($id)->toArray();
    }
}
