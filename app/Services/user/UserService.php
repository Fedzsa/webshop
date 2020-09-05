<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get paginated users.
     *
     * @return mixed
     */
    public function getPaginatedUsers()
    {
        return $this->user->users()->paginate(10);
    }

    /**
     * Get paginated admins.
     *
     * @return mixed
     */
    function getPaginatedAdmins()
    {
        return $this->user->admins()->paginate(10);
    }

    /**
     * Store the new admin.
     *
     * @param array $attributes
     * @return void
     */
    public function storeAdmin(array $attributes): void
    {
        $admin = $this->user->create([
            'firstname' => $attributes['firstname'],
            'lastname' => $attributes['lastname'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'admin' => true
        ]);

        event(new Registered($admin));
    }
}
