@extends('layouts.app')
@include('partials.meta_dynamic')
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
        <div class="jumbotron text-center bg-light form-control">
            <h1 class="display-4">{{ $blog->title }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12 mt-3">
                @if ($blog->featured_image)
                    <img src="{{ asset($blog->featured_image ? $blog->featured_image : ' ') }}"
                        alt="{{ Str::limit($blog->title, 25) }}" width="400" height="300"
                        style="border: 2px solid #639c2b9b; border-radius: 10px;">
                @endif
                {!! $blog->body !!}
                @if ($blog->user)
                    <div class="d-flex justify-content-end">
                        <span class="mr-3">
                            Author: <a style="text-decoration:none;"
                                href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }} </a>
                        </span>
                        <span>
                            Posted: {{ $blog->created_at->diffForHumans() }}
                        </span>
                    </div>
                @endif

                <hr>
                <strong>Categories: </strong>
                @foreach ($blog->category as $category)
                    <span class="category-span mb-3"> <a href="{{ route('categories.show', $category->slug) }}"
                            style="text-decoration:none; color:#fff">{{ $category->name }}</a></span>
                @endforeach



            </div>
        </div>
        @auth
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
        @endauth
    </div>
@endsection
