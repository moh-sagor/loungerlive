@extends('layouts.app')
@section('content')
<div class="container">
    <h2><h5 href="" style="text-decoration: none;">{{ $category->name }}</h5>
    </h2>
    <div class="row">
        <div class="col-md-1 col-sm-1">
            <a class="btn btn-warning btn-sm" href="{{ route('categories.edit', $category->slug) }}">Edit</a>
        </div>
        <div class="col-md-1 col-sm-1">
            <form action="{{ route('categories.destroy', $category->slug) }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
            </form>
        </div>
    </div>
</div>
    
@endsection