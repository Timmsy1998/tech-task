<?php

namespace App\Policies;

use App\Domain\User\Models\User;

class UserPolicy
{
    public function viewAny(User $authUser): bool
    {
        return true; // Everyone can see the list
    }

    public function view(User $authUser, User $user): bool
    {
        return true; // Everyone can view individual users
    }

    public function create(User $authUser): bool
    {
        return $authUser->is_admin;
    }

    public function update(User $authUser): bool
    {
        return $authUser->is_admin;
    }

    public function delete(User $authUser): bool
    {
        return $authUser->is_admin;
    }
}
