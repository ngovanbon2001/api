<?php
namespace App\Repositories\Contracts;

interface BannerRepositoryInterface extends RepositoryInterface
{
    public function list(array $conditions);
    public function testData(int $id);
}