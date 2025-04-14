<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Auth\Requests\LoginRequest;
use App\Domain\Auth\Actions\AttemptLoginAction;
use App\Domain\Auth\Actions\LogoutUserAction;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request, AttemptLoginAction $attemptLogin)
    {
        if ($attemptLogin($request->validated(), $request)) {
            return redirect()->intended('/users');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function logout(Request $request, LogoutUserAction $logoutUser)
    {
        $logoutUser($request);
        return redirect('/login');
    }
}
