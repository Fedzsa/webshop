<?php

namespace App\Services\User;

use App\Models\User;

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
}
