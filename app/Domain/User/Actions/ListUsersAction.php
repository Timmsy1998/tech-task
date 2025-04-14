<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;

class ListUsersAction
{
    public function execute(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::latest()->paginate(10);
    }
}
