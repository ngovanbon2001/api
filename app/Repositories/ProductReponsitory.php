<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductReponsitoryInterface;

class ProductReponsitory extends BaseRepository implements ProductReponsitoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }
}
