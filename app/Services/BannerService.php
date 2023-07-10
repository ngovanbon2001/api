<?php

namespace App\Services;

use App\Constants\Constants;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Services\Contracts\BannerServiceInterface;

class BannerService implements BannerServiceInterface
{
    const paginateFe = 10;
    const paginateBe = 5;

    protected $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        return $this->bannerRepository = $bannerRepository;
    }

    public function list(array $attributes)
    {
        return $this->bannerRepository->findWhere($attributes)->toArray();
    }

    public function create(array $attributes)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = "no-image.png";
        }

        return $this->bannerRepository->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = $attributes['imageOld'];
        }

        return $this->bannerRepository->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->bannerRepository->where("id", "=", $id)->delete();
    }

    public function detail(int $id)
    {
        return $this->bannerRepository->find($id);
    }

}