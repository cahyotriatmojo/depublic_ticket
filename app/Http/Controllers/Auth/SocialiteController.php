<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            
            $registeredUser = User::where('email', $socialUser->email)->first();

            if ($registeredUser) {
                if ($registeredUser->role == 'admin') {
                    return redirect('login')->withErrors(['msg' => 'Email sudah digunan']);
                }

                if (!$registeredUser->google_id) {
                    
                    $registeredUser->update([
                        'google_id' => $socialUser->id,
                        'google_token' => $socialUser->token,
                        'google_refresh_token' => $socialUser->refreshToken,
                    ]);
                }
                // Login pengguna
                Auth::login($registeredUser);
            } else {
               
                $user = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'password' => Hash::make(uniqid()),
                    'google_id' => $socialUser->id,
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                ]);
                
                Auth::login($user);
            }

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('login')->withErrors(['msg' => 'Gagal login dengan Google, silakan coba lagi.']);
        }
    }
}
