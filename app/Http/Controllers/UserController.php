<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Listing the users.
     */
    public function index()
    {
        $users = $this->userService->getPaginatedUsers();
        $admins = $this->userService->getPaginatedAdmins();

        return view('user.index', compact(['users', 'admins']));
    }
}
