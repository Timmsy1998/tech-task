<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;

class GetUserAction
{
    public function execute(int $id): User
    {
        return User::findOrFail($id);
    }
}
