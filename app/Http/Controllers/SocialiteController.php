<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('google_id', $googleUser->id)->first();

        if (!$user) {
            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'password' => encrypt(Str::random(16)),
                'github_id' => $googleUser->id,
                'name' => $googleUser->name,
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}
