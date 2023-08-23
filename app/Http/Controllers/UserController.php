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
        $users = User::all();

        // Calculate role counts
        $roleCounts = [
            'admin' => $users->where('role_id', 1)->count(),
            'author' => $users->where('role_id', 2)->count(),
            'subscriber' => $users->where('role_id', 3)->count(),
        ];

        return view('admin.users', compact('users', 'roleCounts'));
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
        $user = User::findOrFail($id);
        // Update the fields you want to allow the user to change
        $user->update($request->only('name', 'role_id', 'email', 'about', 'phone', 'website', 'linkedin', 'github', 'facebook', 'twitter', 'youtube', 'nid', 'passport', 'address', 'profession'));

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