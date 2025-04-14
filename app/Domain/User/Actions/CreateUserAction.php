<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;

class CreateUserAction
{
    public function execute(array $data): User
    {
        if (isset($data['profile_picture'])) {
            $data['profile_picture'] = $data['profile_picture']->store('profiles', 'public');
        }

        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }
}
