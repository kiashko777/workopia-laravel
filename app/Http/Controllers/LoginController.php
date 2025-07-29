<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    //@desc Show login form
    //@route GET /login
    public function login(): View
    {
        return view('auth.login');
    }

    //@desc Authenticate the user
    //@route POST /login

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ]);

        //Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            //Regenerate the session to prevent attack
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'You are logged in successfully!');
        }
        //If auth fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records!',
        ])->onlyInput('email');

    }
}
