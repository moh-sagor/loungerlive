@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 70px;">
        <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
            <h1 class="display-4">{{ $category->name }}</h1>
        </div>
        <div class="d-flex align-items-center m-2">
            @if (Auth::user() &&
                    (Auth::user()->role_id === 1 || (Auth::user()->role_id === 2 && Auth::user()->id === $category->user_id)))
                <a href="{{ route('categories.edit', $category->slug) }}" type="button" class="btn btn-success me-2">Edit</a>
                <form action="{{ route('categories.destroy', $category->slug) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger delete-btn" type="submit">Delete</button>
                </form>
            @endif
        </div>


        <hr>
        <div class="col-md-12">
            @foreach ($category->blog as $blog)
                <div class="card card-white post mt-2">
                    <div class="card-header post-heading d-flex">
                        <div class="float-start image">
                            @if ($blog->user && $blog->user->photo)
                                <img src="{{ asset('storage/' . $blog->user->photo) }}"
                                    class="img-fluid rounded-circle avatar" alt="user profile image">
                            @else
                                <img src="{{ asset('images/default_profile.jpg') }}" class="img-fluid rounded-circle avatar"
                                    alt="default profile image">
                            @endif
                        </div>
                        @if ($blog->user)
                            <div class="float-start meta ms-2 me-3">
                                <div class="title h5 ubuntu-font">
                                    <a style="text-decoration:none;"
                                        href="{{ route('users.profile_show', $blog->user->username) }}">{{ strtoupper($blog->user->name) }}
                                    </a>
                                </div>
                                <h6 class="text-muted time">{{ $blog->created_at->diffForHumans() }}</h6>
                            </div>
                            <div class="ml-4">
                                @foreach ($blog->category as $category)
                                    <span class="title h5 category-span bg-primary rounded-pill  mx-1 p-1 ">
                                        <a class="mx-2 ubuntu-font" href="{{ route('categories.show', $category->slug) }}"
                                            style="text-decoration:none; color:aliceblue; ">{{ $category->name }}</a>
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="card-body post-description">
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <!-- Image -->
                                @if ($blog->featured_image)
                                    <img src="{{ asset($blog->featured_image) }}" alt="{{ Str::limit($blog->title, 25) }}"
                                        class="img-fluid"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:500px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                @else
                                    <!-- Placeholder image when featured image is empty -->
                                    <img src="{{ asset('images/empty.png') }}" alt="{{ Str::limit($blog->title, 25) }}"
                                        class="img-fluid"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:500px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                @endif

                            </div>
                            <div class="col-md-9 col-12">
                                <h2>{{ Str::limit(ucwords($blog->title), 40) }}</h2>
                                <p style="text-align: justify;">{!! Str::limit(app('purifier')->clean($blog->body, ['HTML.Allowed' => 'p,strong,i,em']), 500) !!}
                                </p>

                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                        class="btn btn-primary">Read More</a>
                                    <span class="text-primary">
                                        <i class="fas fa-comment-dots"></i> {{ $blog->comments->count() }}
                                    </span>
                                    <span class="text-primary">
                                        <i class="fas fa-eye"></i> {{ $blog->view_count }}
                                    </span>

                                    <button class="btn btn-secondary share-button"
                                        data-url="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
                                        <i class="fas fa-share"></i> Share
                                    </button>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
