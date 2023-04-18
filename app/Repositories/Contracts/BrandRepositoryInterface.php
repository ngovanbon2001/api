<?php
namespace App\Repositories\Contracts;

interface BrandRepositoryInterface extends RepositoryInterface
{
    public function detail(int $id);
}