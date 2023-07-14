@extends('layouts.app')
@section('content')
<div class="container offset-md-2">
    <div class="jumbotron text-center bg-light form-control" >
        <h1 class="display-4">Create a new blog</h1>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('blogs.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                </div>
        
                <div class="form-group">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="5" placeholder="Enter body"></textarea>
                </div>
                <div class="form-group form-check-inline">
                    <label for="category" class="form-label mt-4">Select Category</label><br>
                        @foreach ($categories as $category)
                                <input type="checkbox" id="category_{{$category->id}}" name="category_id[]" value="{{$category->id}}">
                                <label class="form-check-label mr-2" for="category_{{$category->id}}"><b>{{$category->name}}</b></label>
                        @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">Create New Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection