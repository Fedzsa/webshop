<?php

namespace App\Services\User;

use App\Services\User\UserServiceInterface;
use App\Repositories\User\UserRepositoryInterface;

class UserService implements UserServiceInterface {
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function getPaginatedUsers() {
        return $this->userRepo->getPaginatedUsers();
    }
}