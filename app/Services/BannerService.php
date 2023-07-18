<?php

namespace App\Services;

use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Services\Contracts\BannerServiceInterface;

class BannerService implements BannerServiceInterface
{
    protected $bannerRepository;

    /**
     * @param BannerRepositoryInterface $bannerRepository
     */
    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        return $this->bannerRepository = $bannerRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        return $this->bannerRepository->list($attributes)->toArray();
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

        return $this->bannerRepository->create($attributes)->toArray();
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

        return $this->bannerRepository->update($attributes, $id)->toArray();
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->bannerRepository->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->bannerRepository->find($id)->toArray();
    }
}
