@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron text-center bg-secondary form-control mb-1">
                <h1 class="display-6">Manage Users</h1>
            </div>
            <div class="col-md-12">
                <div class="row">
                    @foreach ($users as $user)
                        <p>{{ $user->name }}</p>
                    @endforeach
                </div>
            </div>

        </div>
    @endsection
