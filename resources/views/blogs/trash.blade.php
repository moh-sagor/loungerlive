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
@endforeach
<div class="row">
    {{-- <div class="col-md-1 col-sm-2">
        <a class="btn btn-danger btn-sm" href="{{ route('blogs.edit', $trash->id) }}">Delete</a>
    </div> --}}
    <div class="col-md-6 col-sm-12">
        @if(isset($trash) && $trash)
            <form action="{{ route('blogs.restore', $trash->id) }}" method="get">
                @csrf
                <button class="btn btn-primary btn-sm" type="submit">Restore</button>
            </form>
        @else
            <p>No data to restore.</p>
        @endif
    </div>
    
</div>


</div>
    
@endsection