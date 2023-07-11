@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <div class="jumbotron text-center bg-light form-control" >
            <h1 class="display-4">{{$blog->title}}</h1>
        </div>
        
        <div class="row">
            <div class="col-md-12 mt-3">
            <p>{{$blog->body}}</p>
            </div>
        </div>
    </div>


@endsection