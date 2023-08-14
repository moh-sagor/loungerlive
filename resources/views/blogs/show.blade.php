@extends('layouts.app')
@include('partials.meta_dynamic')
@section('content')
    <div class="container">


        <div class="card card-white post mt-2">
            <div class="card-header post-heading d-flex">
                <div class="float-start image">
                    @if ($blog->user && $blog->user->photo)
                        <img src="{{ asset('storage/' . $blog->user->photo) }}" class="img-fluid rounded-circle avatar"
                            alt="user profile image">
                    @else
                        <img src="{{ asset('images/default_profile.jpg') }}" class="img-fluid rounded-circle avatar"
                            alt="default profile image">
                    @endif
                </div>
                @if ($blog->user)
                    <div class="float-start meta ms-2">
                        <div class="title h5">
                            <a style="text-decoration:none;"
                                href="{{ route('users.profile_show', $blog->user->username) }}">{{ strtoupper($blog->user->name) }}
                            </a>
                        </div>
                        <h6 class="text-muted time">{{ $blog->created_at->diffForHumans() }}</h6>
                    </div>
                    <div class="ml-4">
                        @foreach ($blog->category as $category)
                            <span class="title h5 category-span bg-primary rounded-pill  mx-1">
                                <a class="mx-2" href="{{ route('categories.show', $category->slug) }}"
                                    style="text-decoration:none; color:aliceblue; ">{{ $category->name }}</a>
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="card-body post-description">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="text-center">
                            <h2>{{ ucwords($blog->title) }}</h2>
                        </div>

                        <!-- Image -->
                        <div class="d-flex">
                            <div class="row">
                                <div class="col-md-3">
                                    {{-- added next  --}}
                                </div>
                                <div class="col-md-6">
                                    @if ($blog->featured_image)
                                        <img src="{{ asset($blog->featured_image) }}"
                                            alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
                                            style="border: 2px solid #e3e9de9b; border-radius: 10px; height:auto; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                    @else
                                        <!-- Placeholder image when featured image is empty -->
                                        <img src="{{ asset('images/empty.png') }}"
                                            alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
                                            style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:500px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {{-- added next  --}}
                                </div>
                            </div>


                        </div>

                        <p style="text-align: justify;">{!! $blog->body !!}</p>
                    </div>

                </div>

                @if (Auth::user())
                    @if (Auth::user()->role_id === 1 || (Auth::user()->role_id === 2 && Auth::user()->id === $blog->user_id))
                        <div class="row">
                            <div class="col-md-1 col-sm-1">
                                <a class="btn btn-outline-secondary btn-arrow"
                                    href="{{ route('blogs.edit', ['id' => $blog->id, 'slug' => $blog->slug]) }}">Edit</a>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-outline-danger btn-arrow delete-btn">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endif


            </div>
        </div>



        <!-- ... existing content ... -->

        <div class="mt-3">

            <button type="button" class="btn btn-primary position-relative">
                <h6>Comments</h6>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $blog->comments->count() }}
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>

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
                            @if ($comment->user && $comment->user->photo)
                                <img src="{{ asset('storage/' . $comment->user->photo) }}" class="rounded-circle m-2"
                                    style="width: 50px;" alt="Avatar" />
                            @else
                                <img src="{{ asset('images/default_profile.jpg') }}" class="rounded-circle m-2"
                                    style="width: 50px;" alt="Avatar" />
                            @endif
                            <span>
                                <small class="font-weight-bold fs-5">{{ $comment->content }}</small>
                            </span>
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
