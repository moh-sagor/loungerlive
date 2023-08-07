<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // UserController.php
    // UserController.php
    public function show(string $username = null)
    {
        // If $username is null, get the current logged-in user
        if ($username === null) {
            $user = auth()->user();
        } else {
            // If $username is provided, get the user based on the username
            $user = User::where('username', $username)->first();
        }

        return view('users.show', compact('user'));
    }

    public function profile_show(string $username = null)
    {
        // If $username is null, get the current logged-in user
        if ($username === null) {
            $user = auth()->user();
        } else {
            // If $username is provided, get the user based on the username
            $user = User::where('username', $username)->first();
        }

        return view('users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $username)
    {
        $user = User::where('username', $username)->first();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    // UserController.php

    // ...

    public function update(Request $request, string $id)
    {
        // Get the authenticated user
        $authenticatedUser = Auth::user();

        // Check if the authenticated user is the same as the user being edited
        if ($authenticatedUser && $authenticatedUser->id == $id) {
            $user = User::findOrFail($id);

            // Update the fields you want to allow the user to change
            $user->update($request->only('name', 'email', 'about', 'role_id', 'phone', 'website', 'linkedin', 'github', 'facebook', 'twitter', 'youtube', 'nid', 'passport', 'address', 'profession'));

            // Handle the photo upload if it's provided in the request
            if ($request->hasFile('photo')) {
                // Delete the old photo if it exists
                if ($user->photo && Storage::exists($user->photo)) {
                    Storage::delete($user->photo);
                }

                // Store the new photo and update the 'photo' attribute in the database
                $photoPath = $request->file('photo')->store('photos', 'public');
                $user->photo = $photoPath;
            }

            $user->save();

            return back();
        } else {
            // If the authenticated user is not allowed to update this user, you can show an error message or redirect back with an error.
            // For example:
            return back()->withErrors('You are not allowed to update this user.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}