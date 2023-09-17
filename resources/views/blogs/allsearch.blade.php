@extends('layouts.app')
@include('partials.meta_static')
@section('content')
    <style>
        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }
    </style>

    <div class="container" style="padding-top: 70px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search Results</li>
            </ol>
        </nav>
        <div class="mb-2 ubuntu-font p-2"
            style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
            <h3>Your Search Results for <b class="text-danger">"{{ $searchQuery }}"</b></h3>
        </div>

        <!-- Blogs Section -->
        @if ($results['blogs']->isNotEmpty())
            <div class="mb-4">
                <h4 class="mb-3 text-center text-danger">
                    <strong>Your Search Results for Blogs</strong>
                </h4>
                @foreach ($results['blogs'] as $blog)
                    <div class="card card-white post mt-2">
                        <div class="card-header post-heading d-flex">
                            <div class="float-start image">
                                @if ($blog->user && $blog->user->photo)
                                    <img src="{{ asset('storage/' . $blog->user->photo) }}"
                                        class="img-fluid rounded-circle avatar" alt="user profile image">
                                @else
                                    <img src="{{ asset('images/default_profile.jpg') }}"
                                        class="img-fluid rounded-circle avatar" alt="default profile image">
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
                                            <a class="mx-2 ubuntu-font"
                                                href="{{ route('categories.show', $category->slug) }}"
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
                                        <img src="{{ asset($blog->featured_image) }}"
                                            alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
                                            style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:500px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                    @else
                                        <!-- Placeholder image when featured image is empty -->
                                        <img src="{{ asset('images/empty.png') }}"
                                            alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
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
        @endif

        <!-- Movies Section -->
        @if ($results['movies']->isNotEmpty())
            <div class="mb-4">
                <h4 class="mb-3 text-center text-danger">
                    <strong>Your Search Results for Movies</strong>
                </h4>
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-2">
                    @foreach ($results['movies'] as $movie)
                        <div class="col">
                            <div class="card card-v h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
                                style="background: white;">

                                @if ($movie->image)
                                    <img class="card-img-top" src="{{ asset($movie->image) }}"
                                        alt="{{ Str::limit($movie->title, 25) }}" class="img-fluid"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:400px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                    <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                        <div
                                            style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%);">
                                            <i class="fas fa-play fa-3x header-icon"></i>
                                        </div>
                                    </a>
                                @else
                                    <!-- Placeholder image when featured image is empty -->
                                    <img class="card-img-top" src="{{ asset('images/empty.png') }}"
                                        alt="{{ Str::limit($movie->title, 25) }}" class="img-fluid"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:400px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                    <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                        <div
                                            style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%);">
                                            <i class="fas fa-play fa-3x header-icon"></i>
                                        </div>
                                    </a>
                                @endif

                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title text-lg fw-bold text-dark">
                                            <i class="fas fa-film"></i> {{ Str::limit(ucwords($movie->title), 70) }}
                                        </h5>
                                        <h5 class="card-title text-lg fw-bold text-dark">
                                            <i class="far fa-calendar"></i> {{ Str::limit(ucwords($movie->year), 70) }}
                                        </h5>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title text-lg fw-bold text-danger">
                                            <i class="fas fa-user"></i>
                                            {{ Str::limit(ucwords($movie->producer), 70) }}
                                        </h6>
                                        <h6 class="card-title text-lg fw-bold text-primary">
                                            <i class="fas fa-user-friends"></i>
                                            {{ Str::limit(ucwords($movie->actors), 70) }}
                                        </h6>
                                    </div>

                                </div>

                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}"
                                        class="btn btn-primary">Movie Details</a>

                                    <div class="vr me-2"></div>
                                    <span class="text-danger">
                                        <i class="fas fa-eye me-1"></i>{{ $movie->view_count }}
                                    </span>
                                    <div class="vr me-2"></div>
                                    <span class="text-info">
                                        <i class="fas fa-download me-1"></i>{{ $movie->download_count }}
                                    </span>
                                    <div class="vr me-2"></div>
                                    <!-- Replace this with the appropriate share URL for movies -->
                                    <button class="btn btn-secondary share-button"
                                        data-url="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Courses Section -->
        @if ($results['courses']->isNotEmpty())
            <div class="mb-4">
                <h4 class="mb-3 text-center text-danger">
                    <strong>Your Search Results for Courses</strong>
                </h4>
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-2">
                    @foreach ($results['courses'] as $course)
                        <div class="col">
                            <div
                                class="card h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden p-2">

                                @if ($course->image)
                                    <img class="card-img-top" src="{{ asset($course->image) }}"
                                        alt="{{ Str::limit($course->title, 25) }}" class="img-fluid"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:auto; box-shadow: 0px 4px 8px rgba(252, 0, 0, 0.1); ">
                                @else
                                    <!-- Placeholder image when image is empty -->
                                    <img class="card-img-top" src="{{ asset('images/empty.png') }}"
                                        alt="{{ Str::limit($course->title, 25) }}" class="img-fluid"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title text-lg fw-bold text-dark">
                                        {{ Str::limit(ucwords($course->title), 70) }}</h5>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title text-lg fw-bold text-danger">
                                            <i class="fas fa-chalkboard-teacher me-2 "></i>
                                            {{ Str::limit(ucwords($course->instructor), 70) }}
                                        </h6>
                                        <h6 class="card-title text-lg fw-bold text-primary">
                                            <i class="fas fa-building me-2"></i>
                                            {{ Str::limit(ucwords($course->course_author), 70) }}
                                        </h6>
                                    </div>

                                </div>

                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <a href="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}"
                                        class="btn btn-primary">Course Details</a>

                                    <div class="vr me-2"></div>
                                    <span class="text-danger">
                                        <i class="fas fa-eye me-1"></i>{{ $course->view_count }}
                                    </span>
                                    <div class="vr me-2"></div>
                                    <span class="text-info">
                                        <i class="fas fa-download me-1"></i>{{ $course->download_count }}
                                    </span>
                                    <div class="vr me-2"></div>
                                    <!-- Replace this with the appropriate share URL for courses -->
                                    <button class="btn btn-secondary share-button"
                                        data-url="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <a href="#" class="go-to-home">
            <i class="fas fa-home"></i>
        </a>
    </div>


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
                    title: 'Share course',
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
@endsection
