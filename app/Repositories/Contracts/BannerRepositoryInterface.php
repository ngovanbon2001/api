<?php
namespace App\Repositories\Contracts;

interface BannerRepositoryInterface extends RepositoryInterface
{
    public function list(string $title);
    public function findTitle(string $title);
}