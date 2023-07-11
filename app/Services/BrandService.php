<?php

namespace App\Services;

use App\Constants\Constants;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Services\Contracts\BrandServiceInterface;
use App\Supports\RespondResource;

class BrandService implements BrandServiceInterface
{
    use RespondResource;

    protected $brandRepository;

    public function __construct(BrandRepositoryInterface $repositoryInterface)
    {
        return $this->brandRepository = $repositoryInterface;
    }

    public function list(array $attributes)
    {
        return $this->brandRepository->list($attributes);
    }

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

    public function delete(int $id)
    {
        return $this->brandRepository->where("id", "=", $id)->delete();
    }

    public function detail(int $id)
    {
        return $this->brandRepository->find($id);
    }
}
