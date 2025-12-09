<?php

namespace App\Traits;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Auth\Access\Response;
trait IsAdmin
{
    public function isAdmin(User $user): Response
    {
        return $user->role === UserRole::Administrator
            ? Response::allow()
            : Response::deny(message: 'You dont have permission for this');
    }
}
