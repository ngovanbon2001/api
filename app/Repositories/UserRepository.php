<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    public function list($conditions) {
        $this->applyConditions($conditions);
        return $this->model->get()->toArray();
    }

    public function detailTest($email)
    {
        return $this->model->where("email", "like", $email)->get()->toArray();
    }

}
