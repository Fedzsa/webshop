<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService) {
        $this->userService = $userService;

        $this->middleware('auth');
    }

    /**
     * Listing the users.
     */
    public function index() {
        $users = $this->userService->getPaginatedUsers();
        return view('user.index', ['users' => $users]);
    }
}
