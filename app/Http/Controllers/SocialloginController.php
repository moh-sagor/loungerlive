<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialloginController extends Controller
{
    public function gotogoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function apigstore()
    {
        $googleuser = Socialite::driver('google')->user();
        $user = User::where('sid', $googleuser->id)->first();
        if ($user == null) {
            $store = new User();
            $store->name = $googleuser->name;
            $store->username = Str::slug(strtolower($googleuser->name));
            $store->email = $googleuser->email;
            $store->photo = $googleuser->avatar;
            $store->sid = $googleuser->id;
            $store->password = Hash::make($googleuser->email);
            $store->role_id = 3;
            $store->save();
            Auth::login($store);
            return redirect()->route('users.show');


        } else {
            Auth::login($user);
            return redirect()->route('users.show');
        }


    }
}