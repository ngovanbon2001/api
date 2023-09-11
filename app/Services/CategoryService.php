<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryReponsitoryInterface;
use App\Services\Contracts\CategoryServiceInterface;
use Exception;

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
        try {
            return $this->categoryReponsitoryInterface->create($attributes)->toArray();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        try {
            $category = $this->categoryReponsitoryInterface->find($id);

            if ($category) {
                $category->update($attributes);
            }

            return $category->toArray() ?? false;
        } catch (Exception $e) {
            return false;
        }
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
