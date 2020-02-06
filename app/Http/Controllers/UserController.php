<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService) {
        $this->userService = $userService;
    }

    public function index() {
        $users = $this->userService->getUsers();
        return view('user.index', ['users' => $users]);
    }
}
