<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryReponsitoryInterface;

class CategoryReponsitory extends BaseRepository implements CategoryReponsitoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }

    public function detail(int $id)
    {
        return $this->model->where('id', $id)->with('product')->get();
    }

}
