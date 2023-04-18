<?php
namespace App\Repositories\Contracts;

interface CategoryReponsitoryInterface extends RepositoryInterface
{
    public function detail(int $id);
}