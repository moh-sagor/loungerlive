@extends('layouts.app')
@section('content')
<div class="container offset-md-2">
    <div class="jumbotron text-center bg-light form-control" >
        <h1 class="display-4">Admin Dashboard</h1>
    </div>
<div class="col-md-12 mt-3">
    <button class="btn btn-primary btn-margin-right">
        <a href="{{route('blogs.create')}}" class="text-white" style="text-decoration: none">Create Blog</a>
    </button>
    <button class="btn btn-secondary btn-margin-right">
        <a href="{{route('blogs.trash')}}" class="text-white" style="text-decoration: none">Trashed Blog</a>
    </button>
    <button class="btn btn-info btn-margin-right">
        <a href="{{route('categories.create')}}" class="text-white" style="text-decoration: none">Create Category</a>
    </button>
</div>
</div>
    
@endsection
