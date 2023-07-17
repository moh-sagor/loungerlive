@extends('layouts.app')
@section('content')
    <div class="container offset-md-2">
        <div class="jumbotron text-center bg-light form-control">
            <h1 class="display-4">Admin Dashboard</h1>
        </div>
        <div class="col-md-12 mt-3">
            <button class="btn btn-primary btn-margin-right mt-1">
                <a href="{{ route('blogs.create') }}" class="text-white" style="text-decoration: none">Create Blog</a>
            </button>
            <button class="btn btn-secondary btn-margin-right mt-1">
                <a href="{{ route('blogs.trash') }}" class="text-white" style="text-decoration: none">Trashed Blog</a>
            </button>
            <button class="btn btn-info btn-margin-right mt-1">
                <a href="{{ route('categories.create') }}" class="text-white" style="text-decoration: none">Create
                    Category</a>
            </button>
            <button class="btn btn-warning btn-margin-right mt-1">
                <a href="{{ route('admin.blogs') }}" class="text-white" style="text-decoration: none">Published /
                    Drafted</a>
            </button>
        </div>
    </div>
@endsection
