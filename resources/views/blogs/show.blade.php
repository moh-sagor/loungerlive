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
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset($blog->featured_image ? $blog->featured_image : ' ') }}"
                            alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
                            style="border: 2px solid #639c2b9b; border-radius: 10px; width: 600px; height: 400px;">
                    </div>
                @endif
                {!! $blog->body !!}
                @if ($blog->user)
                    <div class="d-flex justify-content-end">
                        <span class="mr-3">
                            Author: <a style="text-decoration:none;"
                                href="{{ route('users.show', $blog->user->username) }}">{{ $blog->user->name }} </a>
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
        @if (Auth::user())
            @if (Auth::user()->role_id === 1 || (Auth::user()->role_id === 2 && Auth::user()->id === $blog->user_id))
                <div class="row">
                    <div class="col-md-1 col-sm-1">
                        <a class="btn btn-warning btn-sm"
                            href="{{ route('blogs.edit', ['id' => $blog->id, 'slug' => $blog->slug]) }}">Edit</a>
                    </div>
                    <div class="col-md-1 col-sm-1">
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm delete-btn" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            @endif
        @endif



        <!-- ... existing content ... -->

        <hr>

        <div class="mt-3">

            <h3>Comments</h3>

            @if (Auth::check())
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <form action="{{ route('comments.store', $blog->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="3" placeholder="Add a comment..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Post Comment</button>
                        </form>
                    </div>
                </div>
            @else
                <p class="mt-3">Please <a href="{{ route('login') }}">login</a> to post a comment.</p>
            @endif


            @foreach ($blog->comments->reverse() as $comment)
                <div class="card p-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center">

                            <i class="fas fa-user-circle fa-3x mr-2 me-3 text-primary"></i>

                            <span>
                                <small class="font-weight-bold fs-5">{{ $comment->content }}</small></span>
                        </div>
                        <small>{{ $comment->created_at->format('F j, Y') }}</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply text-red">
                            Comment by <span style="color:blue;">{{ $comment->user->name }}</span>

                        </div>
                    </div>
                </div>
            @endforeach


        </div>




    </div>
@endsection
