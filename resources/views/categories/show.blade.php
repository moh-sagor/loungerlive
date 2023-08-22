@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 70px;">
        <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
            <h1 class="display-4">{{ $category->name }}</h1>
        </div>
        @auth
            <div class="d-flex align-items-center m-2">
                <a href="{{ route('categories.edit', $category->slug) }}" type="button" class="btn btn-success me-2">Edit</a>
                <form action="{{ route('categories.destroy', $category->slug) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger delete-btn" type="submit">Delete</button>
                </form>
            </div>

        @endauth

        <hr>
        <div class="col-md-12">
            @foreach ($category->blog as $blog)
                <div class="container border-left border-right">
                    <div class="d-flex py-1">
                        <div class="second py-2 px-2">
                            @if ($blog->featured_image)
                                <img src="{{ asset($blog->featured_image) }}" alt="{{ Str::limit($blog->title, 25) }}"
                                    class="img-fluid"
                                    style="border: 2px solid #e3e9de9b; border-radius: 10px; height:50px; width:50px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                            @else
                                <!-- Placeholder image when featured image is empty -->
                                <img src="{{ asset('images/empty.png') }}" alt="{{ Str::limit($blog->title, 25) }}"
                                    class="img-fluid"
                                    style="border: 2px solid #e3e9de9b; border-radius: 10px; height:50px; width:50px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                            @endif

                            <span class="text1 ms-2 ubuntu-font">
                                <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                    style="text-decoration:none">{{ $blog->title }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
