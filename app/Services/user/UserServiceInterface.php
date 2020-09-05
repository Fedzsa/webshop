<?php

namespace App\Services\User;

interface UserServiceInterface
{
    function getPaginatedUsers();
    function getPaginatedAdmins();
}
