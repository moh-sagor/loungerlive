@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 70px;">
        <div class="row">
            <div class="jumbotron text-center bg-secondary form-control mb-1">
                <h1 class="display-6">Manage Users</h1>
            </div>
            <div class="col-md-12">
                <div class="row justify-content-between">
                    @php
                        $serialNumber = 1;
                    @endphp
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">UserName</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ $serialNumber }}</th>
                                        <td> <a href="{{ route('users.show', $user->username) }}"
                                                style="text-decoration: none">{{ $user->username }}</a></td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <select name="role_id" id="role" class="form-control">
                                                <option value="{{ $user->role->name }}" selected>
                                                    {{ ucfirst($user->role->name) }}</option>
                                                <option value="2">Author</option>
                                                <option value="3">Subscriber</option>
                                            </select>


                                        </td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                                </form>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                                    class="ms-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger mt-2 delete-btn"
                                                        data-user-id="{{ $user->id }}">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $serialNumber++;
                                    @endphp
                                </tbody>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    @endsection
