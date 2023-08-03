@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron text-center bg-light form-control">
            <h1 class="display-4">{{ ucfirst(Auth::user()->role->name) }} Dashboard</h1>
        </div>

        <div class="col-md-12 mt-3">

            @if (Auth::user() && Auth::user()->role_id === 1)
                <button class="btn btn-primary btn-margin-right mt-1">
                    <a href="{{ route('blogs.create') }}" class="text-white" style="text-decoration: none">Create Blog</a>
                </button>
                <button class="btn btn-info btn-margin-right mt-1">
                    <a href="{{ route('categories.create') }}" class="text-white" style="text-decoration: none">Create
                        Category</a>
                </button>
                <button class="btn btn-danger btn-margin-right mt-1">
                    <a href="{{ route('blogs.trash') }}" class="text-white" style="text-decoration: none">Trashed Blog</a>
                </button>
                <button class="btn btn-warning btn-margin-right mt-1">
                    <a href="{{ route('admin.blogs') }}" class="text-white" style="text-decoration: none">Published /
                        Drafted</a>
                </button>
                <button class="btn btn-secondary btn-margin-right mt-1">
                    <a href="{{ route('admin.users') }}" class="text-white" style="text-decoration: none">Manage Users</a>
                </button>
                <button class="btn btn-primary btn-margin-right mt-1">
                    <a href="{{ route('users.edit', ['username' => Auth::user()->username]) }}" class="text-white"
                        style="text-decoration: none">Update Profile</a>
                </button>
            @endif

            @if (Auth::user() && Auth::user()->role_id === 2)
                <button class="btn btn-primary btn-margin-right mt-1">
                    <a href="{{ route('blogs.create') }}" class="text-white" style="text-decoration: none">Create
                        Blog</a>
                </button>
                <button class="btn btn-info btn-margin-right mt-1">
                    <a href="{{ route('categories.create') }}" class="text-white" style="text-decoration: none">Create
                        Category</a>
                </button>
                <button class="btn btn-primary btn-margin-right mt-1">
                    <a href="{{ route('users.edit', ['username' => Auth::user()->username]) }}" class="text-white"
                        style="text-decoration: none">Update Profile</a>
                </button>
            @endif

            <!-- users/show.blade.php -->
            @if (Auth::user() && Auth::user()->role_id === 3)
                <button class="btn btn-primary btn-margin-right mt-1">
                    <a href="{{ route('users.edit', ['username' => Auth::user()->username]) }}" class="text-white"
                        style="text-decoration: none">Update Profile</a>
                </button>
            @endif

        </div>
    </div>
@endsection
