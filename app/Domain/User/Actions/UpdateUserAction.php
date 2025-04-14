<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;

class UpdateUserAction
{
    public function execute(User $user, array $data): User
    {
        if (isset($data['profile_picture'])) {
            $data['profile_picture'] = $data['profile_picture']->store('profiles', 'public');
        }

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }
}
