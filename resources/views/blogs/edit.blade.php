@extends('layouts.app')
@section('content')
<div class="container offset-md-2">
    <div class="jumbotron text-center bg-light form-control" >
        <h1 class="display-4">Edit the blog</h1>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('blogs.update',$blog->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$blog->title}}">
                </div>
        
                <div class="form-group">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="5" >{{$blog->body}}</textarea>
                </div>
        
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection