<?php

namespace App\Services\User;

use App\Models\User;

class UserService implements UserServiceInterface {

    public function __construct() {
    }

    public function getPaginatedUsers() {
        return User::paginate(10);
    }
}
