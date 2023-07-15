@extends('layouts.app')
@section('content')
    <div class="container">
        <style>
            .category-span {
                display: inline-block;
                background-color: #007bff;
                color: #fff;
                padding: 0.25em 0.5em;
                border-radius: 0.25rem;
                margin-right: 0.5em;
            }
        </style>
        <div class="jumbotron text-center bg-light form-control" >
            <h1 class="display-4">{{$blog->title}}</h1>
        </div>
        
        <div class="row">
            <div class="col-md-12 mt-3">
            <p>{{$blog->body}}</p>
            <hr>
            
            <strong>Categories: </strong>
            @foreach ($blog->category as $category)
                <span class="category-span mb-3"> <a href="{{route('categories.show',$category->slug)}}" style="text-decoration:none; color:#fff">{{ $category->name }}</a></span>
            @endforeach
            
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-1 col-sm-1">
                <a class="btn btn-warning btn-sm" href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
            </div>
            <div class="col-md-1 col-sm-1">
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>


@endsection