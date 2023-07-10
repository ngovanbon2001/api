<?php
namespace App\Repositories\Contracts;

interface BannerRepositoryInterface extends RepositoryInterface
{
    public function list(string $title);
}