@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Auth::check() && Auth::user()->id === $user->id)
            <h3>Hello, {{ $user->name }}</h3>
            <img src="{{ asset('storage/' . $user->photo) }}" height="120" width="100" alt="User Photo">
            <p>Update your Profile !</p>
            <hr>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="about" class="form-label">About</label>
                    <textarea class="form-control" id="about" name="about" rows="5">{{ $user->about }}</textarea>
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                </div>
                <div class="form-group">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        @else
            <p>You are not allowed to edit this user's details.</p>
        @endif
    </div>
@endsection
