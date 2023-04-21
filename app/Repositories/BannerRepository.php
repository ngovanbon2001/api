<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\Contracts\BannerRepositoryInterface;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Banner::class;
    }

    public function list($conditions) {
        $this->applyConditions($conditions);
        return $this->model->get()->toArray();
    }

    public function findTitle($title)
    {
        return $this->model->where('title', 'like', '%'.$title.'%')->get();
    }

}
