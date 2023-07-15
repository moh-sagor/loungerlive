@extends('layouts.app')
@section('content')
<div class="container">
    <div class="jumbotron text-center bg-light form-control mb-2" >
        <h1 class="display-4">{{ $category->name }}</h1>
    </div>
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
    <hr>
    <div class="col-md-12">
        @foreach ($category->blog as $blog)
        <h3><a href="{{route('blogs.show',$blog->id)}}" style="text-decoration:none">{{$blog->title}}</a></h3>
            
        @endforeach
    </div>
</div>
    
@endsection