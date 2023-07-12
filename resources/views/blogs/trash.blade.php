@extends('layouts.app')
@section('content')
    <div class="container offset-md-2">
        <div class="jumbotron text-center bg-light form-control" >
            <h1 class="display-4">Restore the blog</h1>
        </div>
    @foreach ($trashedBlogs as $trash)
    <h2><a href="{{ route('blogs.show', $trash->id) }}" style="text-decoration: none;">{{ $trash->title }}</a>
    </h2>
    <p>{{ $trash->body }}</p>

<div class="row">
    @if(isset($trash) && $trash)
        <div class="col-md-6 col-sm-6">
            <div class="d-flex">
                <a class="btn btn-danger btn-sm me-2" href="{{ route('blogs.parmanent-delete', $trash->id) }}">Delete Parmanently</a>
                <form action="{{ route('blogs.restore', $trash->id) }}" method="get">
                    @csrf
                    <button class="btn btn-primary btn-sm" type="submit">Restore</button>
                </form>
            </div>
        </div>
    @else
        <div class="col-md-12">
            <p>No data to restore.</p>
        </div>
    @endif
</div>
@endforeach
</div>
    
@endsection