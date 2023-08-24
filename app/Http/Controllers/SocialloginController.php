<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


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
            $store->sid = $googleuser->id;
            $store->password = Hash::make($googleuser->email);
            $store->role_id = 3;

            $image = Image::make($googleuser->avatar)->encode('jpg', 90);
            $photoPath = 'photos/' . $store->id . '_' . Str::random(10) . '.jpg';
            Storage::disk('public')->put($photoPath, $image->stream());
            $store->photo = $photoPath;
            $store->save();
            Auth::login($store);
            return redirect()->route('users.show');

        } else {
            Auth::login($user);
            return redirect()->route('users.show');
        }


    }
}