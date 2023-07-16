@extends('layouts.app')
@section('content')

@include('partials.meta_static')
<div class="container">
    @foreach ($blogs as $blog)
    <h2><a href="{{ route('blogs.show', $blog->id) }}" style="text-decoration: none;">{{ $blog->title }}</a>
    </h2>
    
    {!!$blog->body!!}
@endforeach
</div>
    
@endsection
