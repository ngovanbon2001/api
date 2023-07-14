<?php

namespace App\Services;

use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Services\Contracts\BrandServiceInterface;

class BrandService implements BrandServiceInterface
{
    protected $brandRepository;

    /**
     * @param BrandRepositoryInterface $repositoryInterface
     */
    public function __construct(BrandRepositoryInterface $repositoryInterface)
    {
        return $this->brandRepository = $repositoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        return $this->brandRepository->list($attributes);
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

        return $this->brandRepository->create($attributes);
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

        return $this->brandRepository->update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->brandRepository->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->brandRepository->find($id);
    }
}
