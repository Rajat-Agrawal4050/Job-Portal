<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to Google’s OAuth page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function callback(Request $r)
    {
        try {
            // Get the user information from Google
            $user = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            return redirect('/login')->with('error', 'Google authentication failed.');
        }

        // Check if the user already exists in the database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Log the user in if they already exist
            Auth::login($existingUser);
            $r->session()->regenerate();
        } else {
            // Otherwise, create a new user and log them in
            $newUser = User::create([
                'email' => $user->email,
                'name' => $user->name,
                'password' => Hash::make(Str::random(16)), // Set a random password
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            Auth::login($newUser);
            $r->session()->regenerate();
        }

        // Redirect the user to the dashboard or any other secure page
        return redirect('/user/profile');
    }
}
