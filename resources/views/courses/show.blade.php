@extends('layouts.app')
@include('partials.meta_dynamic_course')
@section('content')
    <div class="container" style="padding-top: 70px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('courses.index') }}">Courses</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
            </ol>
        </nav>


        <div class="card card-white post mt-2 mb-4">
            <div class="card-header post-heading d-flex">
                <div class="float-start image">
                    @if ($course->user && $course->user->photo)
                        <img src="{{ asset('storage/' . $course->user->photo) }}" class="img-fluid rounded-circle avatar"
                            alt="user profile image">
                    @else
                        <img src="{{ asset('images/default_profile.jpg') }}" class="img-fluid rounded-circle avatar"
                            alt="default profile image">
                    @endif
                </div>
                @if ($course->user)
                    <div class="float-start meta ms-2">
                        <div class="title h5">
                            <a style="text-decoration:none;"
                                href="{{ route('users.profile_show', $course->user->username) }}">{{ strtoupper($course->user->name) }}
                            </a>
                        </div>
                        <h6 class="text-muted time">{{ $course->created_at->diffForHumans() }}</h6>
                    </div>
                @endif
            </div>

            <div class="card-body post-description">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="text-center">
                            <h2>{{ ucwords($course->title) }}</h2> <br>
                        </div>

                        <!-- Image -->
                        <div class="d-flex">
                            <div class="row">
                                <div class="col-md-3">
                                    {{-- added next  --}}
                                </div>
                                <div class="col-md-6">
                                    @if ($course->image)
                                        <img src="{{ asset($course->image) }}" alt="{{ Str::limit($course->title, 25) }}"
                                            class="img-fluid"
                                            style="border: 2px solid #e3e9de9b; border-radius: 10px; height:auto; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                    @else
                                        <!-- Placeholder image when featured image is empty -->
                                        <img src="{{ asset('images/empty.png') }}"
                                            alt="{{ Str::limit($course->title, 25) }}" class="img-fluid"
                                            style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:500px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {{-- added next  --}}
                                </div>
                            </div>

                        </div>

                        <p style="text-align: justify;">{!! $course->body !!}</p>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">

                    @if (Auth::user())
                        @if (Auth::user()->role_id === 1 || (Auth::user()->role_id === 2 && Auth::user()->id === $course->user_id))
                            <div class="d-flex align-items-center m-2">
                                <a href="{{ route('courses.edit', ['id' => $course->id, 'slug' => $course->slug]) }}"
                                    type="button" class="btn btn-success me-2">Edit</a>
                                <form action="{{ route('courses.destroy', $course->id) }} " method="POST">
                                    @csrf
                                    <button class="btn btn-danger delete-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endif

                    <span class="text-danger">
                        <i class="fas fa-eye me-1"></i>
                    </span>

                    <span class="text-primary">
                        <i class="fas fa-comment-dots"></i>
                    </span>

                    <button class="btn btn-secondary share-button"
                        data-url="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}">
                        <i class="fas fa-share"></i> Share
                    </button>
                </div>
            </div>
        </div>

        <!-- ... existing comments ... -->

        {{-- <div class="mt-3">

            <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary position-relative">
                    <h6>Comments</h6>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    </span>
                </button>


            </div>


            @if (Auth::check())
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <form action="{{ route('comments.course.store', $course->id) }}" method="post">
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


            @foreach ($course->comments->reverse() as $comment)
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

        </div> --}}


        {{-- you may like  --}}

        {{-- <div class="mb-2 mt-2 ubuntu-font p-2 "
            style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
            <h3 class="text-danger"><b>You May Like</b></h3>
        </div> --}}

        {{-- <div class="row row-cols-1 row-cols-md-3 g-4">
            @php
                $shuffledcourses = $courseshow->shuffle()->take(6);
            @endphp

            @foreach ($shuffledcourses as $course)
                <div class="col">
                    <div class="card h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">

                        @if ($course->image)
                            <img class="card-img-top" src="{{ asset($course->image) }}"
                                alt="{{ Str::limit($course->title, 25) }}" class="img-fluid"
                                style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                        @else
                            <!-- Placeholder image when featured image is empty -->
                            <img class="card-img-top" src="{{ asset('images/empty.png') }}"
                                alt="{{ Str::limit($course->title, 25) }}" class="img-fluid"
                                style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title text-lg fw-bold text-dark">
                                {{ Str::limit(ucwords($course->title), 30) }}</h5>
                            <p>{!! Str::limit(app('purifier')->clean($course->body, ['HTML.Allowed' => 'p,strong,i,em']), 100) !!}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}"
                                class="btn btn-primary">Read More</a>
                            <span class="text-info">
                                <i class="fas fa-comment-dots"></i> {{ $course->comments->count() }}
                            </span>

                            <span class="text-danger">
                                <i class="fas fa-eye me-1"></i> {{ $course->view_count }}
                            </span>

                            <button class="btn btn-secondary share-button"
                                data-url="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}">
                                <i class="fas fa-share"></i> Share
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}


        <a href="#" class="go-to-home">
            <i class="fas fa-home"></i>
        </a>

        <script>
            document.querySelector(".go-to-home").addEventListener("click", function(event) {
                event.preventDefault();
                // Scroll to the top of the page
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        </script>



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Share button click event
                const shareButtons = document.querySelectorAll('.share-button');
                shareButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const url = this.getAttribute('data-url');
                        showShareDialog(url);
                    });
                });

                // Function to show the SweetAlert share dialog
                function showShareDialog(url) {
                    Swal.fire({
                        title: 'Share This Artical',
                        html: `
                    <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                    <i class="fab fa-facebook"></i> Share on Facebook
                </a>
                <br>
                <a href="https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                    <i class="fab fa-twitter"></i> Share on Twitter
                </a>
                <br>
                <a href="https://www.linkedin.com/shareArticle?url=${encodeURIComponent(url)}" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                    <i class="fab fa-linkedin"></i> Share on LinkedIn
                </a>
                <br>
                <div class="input-group mt-2">
                    <input type="text" class="form-control" value="${url}" id="share-url">
                    <button class="btn btn-secondary copy-button">Copy</button>
                </div>
            `,
                        showCancelButton: true,
                        cancelButtonText: 'Close',
                        showConfirmButton: false,
                    });

                    const copyButton = document.querySelector('.copy-button');
                    copyButton.addEventListener('click', function() {
                        const shareUrlInput = document.getElementById('share-url');
                        shareUrlInput.select();
                        document.execCommand('copy');
                        Swal.fire({
                            icon: 'success',
                            title: 'Link Copied',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                }
            });
        </script>

    </div>
@endsection
