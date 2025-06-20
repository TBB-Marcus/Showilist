<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Register a new user
     * Requires username, email, password, and password confirmation.
     * Validates the input and creates a new user in the database.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request) {
        $request->validate([
            'username' => ['required', 'unique:users,username', 'string', 'min:3', 'max:32'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()]
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/auth?login')->with('message', 'Registration successful, you can now log in.');
    }

    /**
     * Log in a user
     * Requires email and password.
     * Validates the input and attempts to log in the user.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request) {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validated, $request->get('remember'))) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user
     * Destroys the session and redirects to the home page.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();
        return redirect('/')
        ->with('message', 'You have been logged out successfully.');
    }

}
