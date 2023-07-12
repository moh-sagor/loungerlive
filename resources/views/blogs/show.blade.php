@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron text-center bg-light form-control" >
            <h1 class="display-4">{{$blog->title}}</h1>
        </div>
        
        <div class="row">
            <div class="col-md-12 mt-3">
            <p>{{$blog->body}}</p>
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