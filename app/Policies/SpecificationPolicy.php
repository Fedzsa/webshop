<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Specification;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any specifications.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the specification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specification  $specification
     * @return mixed
     */
    public function view(User $user, Specification $specification)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create specifications.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the specification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specification  $specification
     * @return mixed
     */
    public function update(User $user, Specification $specification)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the specification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specification  $specification
     * @return mixed
     */
    public function delete(User $user, Specification $specification)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the specification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specification  $specification
     * @return mixed
     */
    public function restore(User $user, Specification $specification)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the specification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specification  $specification
     * @return mixed
     */
    public function forceDelete(User $user, Specification $specification)
    {
        return $user->isAdmin();
    }
}
