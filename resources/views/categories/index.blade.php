@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 70px;">
        @foreach ($categories as $category)
            <h2><a href="{{ route('categories.show', $category->slug) }}"
                    style="text-decoration: none;">{{ $category->name }}</a>
            </h2>
        @endforeach
    </div>
@endsection
