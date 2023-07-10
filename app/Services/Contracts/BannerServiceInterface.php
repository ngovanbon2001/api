<?php

namespace App\Services\Contracts;

interface BannerServiceInterface
{
    public function list(array $attributes);

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function delete(array $attributes, int $id);

    public function detail(int $id);
}