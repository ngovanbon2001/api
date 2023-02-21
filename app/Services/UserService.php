<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function list(array $attributes)
    {
        return $this->userRepository->list($attributes);
    }

    public function create(array $attributes)
    {
        return $this->userRepository->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        return $this->userRepository->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->userRepository->delete($id);
    }

    public function detail(int $id)
    {
        $conditions = [
            'id' => $id
        ];
        return $this->userRepository->findWhereFirst($conditions);
    }
}