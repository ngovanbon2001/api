<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Contracts\BrandRepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Brand::class;
    }

    public function detail(int $id)
    {
        return $this->model->where('id', $id)->with('product')->get();
    }

}
