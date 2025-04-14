<?php

namespace App\Domain\Auth\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AttemptLoginAction
{
    public function __invoke(array $credentials, Request $request): bool
    {
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return true;
        }

        return false;
    }
}
