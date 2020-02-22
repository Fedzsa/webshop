<?php

namespace App\Repositories\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface {
    
    public function getPaginatedUsers() {
        return User::paginate(10);
    }
}