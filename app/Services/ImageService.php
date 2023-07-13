<?php

namespace App\Services;

use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Services\Contracts\ImageServiceInterface;
use App\Supports\RespondResource;

class ImageService implements ImageServiceInterface
{
    use RespondResource;

    protected $imageRepositoryInterface;

    public function __construct(ImageRepositoryInterface $imageRepositoryInterface)
    {
        return $this->imageRepositoryInterface = $imageRepositoryInterface;
    }

    public function list(array $attributes)
    {
        return $this->imageRepositoryInterface->list($attributes);
    }

    public function create(array $attributes)
    {
        $attribute = [];

        foreach ($attributes['image_url'] as $key => $value) {
            $attribute[] = $attributes;
            $attribute[$key]['image_url'] = handleImage($value);
        }

        return $this->imageRepositoryInterface->insertOrUpdateBatch($attribute);
    }

    
    public function update(array $attributes, int $id)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = $attributes['oldImage'];
        }

        return $this->imageRepositoryInterface->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->imageRepositoryInterface->where("id", "=", $id)->delete();
    }

    public function detail(int $id)
    {
        return $this->imageRepositoryInterface->find($id);
    }
}