<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate login credentials
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check user role and redirect accordingly
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Define your admin route here
            } else {
                return redirect()->route('users.home'); // Define your user route here
            }
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }
}
