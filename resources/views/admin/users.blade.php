@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron text-center bg-secondary form-control mb-1">
                <h1 class="display-6">Manage Users</h1>
            </div>
            <div class="col-md-12">
                <div class="row justify-content-between">
                    @foreach ($users as $user)
                        <form action="{{ route('users.update', $user->id) }}" method="POST"
                            class="col-md-2 border rounded p-3 m-1">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" value="{{ $user->name }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select name="role_id" id="role" class="form-control">
                                    <option selected>{{ $user->role->name }}</option>
                                    <option value="2">Author</option>
                                    <option value="3">Subscriber</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label for="created_at">Created At:</label>
                                <input type="text" class="form-control" id="created_at"
                                    value="{{ $user->created_at->diffForHumans() }}" disabled>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                        <form action="{{ route('users.destroy', $user) }}" method="post" class="ms-2">
                            @csrf
                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                        </form>
                </div>
                @endforeach
            </div>
        </div>




    </div>
@endsection
