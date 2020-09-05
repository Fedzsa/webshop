<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdmin;
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

    /**
     * Display the create admin page.
     */
    public function createAdmin()
    {
        return view('user.admin.create');
    }

    /**
     * Store the new admin. If the user is not admin then
     * the StoreAdmin request is return an unauthorized response.
     */
    public function storeAdmin(StoreAdmin $request)
    {
        $this->userService->storeAdmin($request->validated());

        return back()->with('status', 'Admin created!');
    }
}
