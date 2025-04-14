<?php

namespace App\Domain\Auth\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutUserAction
{
    public function __invoke(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
