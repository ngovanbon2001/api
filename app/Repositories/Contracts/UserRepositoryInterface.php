<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function list(array $conditions);

    public function detailTest(string $email);
}
