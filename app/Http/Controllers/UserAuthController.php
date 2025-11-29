<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

public function login(Request $request)
{
    $request->validate([
        'phone' => 'required|string',
        'password' => 'required|string',
    ]);

    $user = DB::table('users')->where('phone', $request->phone)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    // Store user info in session
    session([
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'reg_id' => $user->reg_id,
            'type' => $user->user_type,
        ],
    ]);

    return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
}
    /**
     * Handle logout request.
     */
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('user.login.form');
    }
}
