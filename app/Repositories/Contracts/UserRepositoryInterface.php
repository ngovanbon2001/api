<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function list(array $conditions);
}
