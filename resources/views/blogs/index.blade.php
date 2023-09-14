@extends('layouts.app')
@include('partials.meta_static')
@include('movies.jsandcss')
@section('content')
    <style>
        .card {
            transition: transform 0.2s;
            /* Add a smooth transition for the transform property */
        }

        .card:hover {
            transform: scale(1.10);
            /* Zoom in on hover */
        }

        .cat-hover {
            transition: transform 0.2s;
        }

        .cat-hover:hover {
            transform: scale(1.10);
        }
    </style>
    <div class="container" style="padding-top: 70px;">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-2 col-3 col-sm-3">
                        <p id="location" style="display: none;"></p>
                        <p class="form-control text-center ubuntu-font" id="time"></p>
                    </div>
                    <div class="col-md-10 col-9 col-sm-9">
                        <form action="{{ route('blogs.search') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search ...">
                                <button type="submit" class="btn btn-primary ubuntu-font">Search</button>
                            </div>
                        </form>
                    </div>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
                @if (isset($message1))
                    <script>
                        // Show the SweetAlert with auto-dismiss and a close button
                        Swal.fire({
                            title: 'Search is not Found',
                            text: "{{ $message1 }}",
                            icon: 'warning',
                            showConfirmButton: false, // Hide the Confirm (OK) button
                            showCancelButton: true, // Show the Cancel button
                            cancelButtonColor: '#d33',
                        })
                    </script>
                @endif


                {{-- post part  --}}

                @foreach ($blogs as $blog)
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

                <div class="d-flex justify-content-center mt-2 ">
                    <a class="btn btn-danger" href="{{ route('blogs.bindex') }}">More Blogs</a>
                </div>

                {{-- courses  --}}

                <div class="row row-cols-1 row-cols-md-3 g-4 mt-2 ">
                    @foreach ($courses as $course)
                        <div class="col">
                            <div class="card h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden p-2"
                                style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">

                                @if ($course->image)
                                    <img class="card-img-top" src="{{ asset($course->image) }}"
                                        alt="{{ Str::limit($course->title, 25) }}" class="img-fluid"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:auto; box-shadow: 0px 4px 8px rgba(23, 81, 73, 0.365);">
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

                <div class="d-flex justify-content-center mt-2">
                    <a class="btn btn-danger" href="{{ route('courses.index') }}">More Courses</a>
                </div>




                {{-- movies  --}}
                <div class="container-movie mt-5">
                    @foreach ($movies as $movie)
                        <div class="movie-card">
                            <div class="movie-header"
                                style="background:url({{ asset($movie->image) }}); background-size:cover;
                                background-position:top;">
                                <div class="header-icon-container">
                                    <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                        <i class="material-icons header-icon"></i>
                                    </a>
                                </div>
                            </div><!--movie-header-->
                            <div class="movie-content">
                                <div class="movie-content-header">
                                    <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}"
                                        style="text-decoration: none;">
                                        <h3 class="movie-title">{{ Str::limit(ucwords($movie->title), 70) }}</h3>
                                        <div class="vr ms-2 me-2"></div>
                                        <h3 class="movie-title">{{ Str::limit(ucwords($movie->year), 70) }}</h3>
                                    </a>
                                    <div class="imax-logo">
                                    </div>

                                </div>
                                <div class="movie-info">
                                    <div class="info-section">
                                        <label> <i class="fas fa-user"></i> Producer :
                                            {{ Str::limit(ucwords($movie->producer), 70) }}</label>
                                        <span> <i class="fas fa-user-friends"></i>
                                            {{ Str::limit(ucwords($movie->actors), 70) }}</span>
                                    </div><!--date,time-->
                                    <div class="info-section">
                                        <label><i class="fas fa-eye me-1"></i></label>
                                        <span>{{ $movie->view_count }}</span>
                                    </div><!--screen-->
                                    <div class="info-section">
                                        <label> <i class="fas fa-download me-1"></i></label>
                                        <span>{{ $movie->download_count }}</span>
                                    </div><!--row-->
                                    <div class="info-section">
                                        <label><a class="share-button"
                                                data-url="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                                <i class="fas fa-share"></i>
                                            </a></label>
                                    </div>
                                </div>
                            </div><!--movie-content-->
                        </div><!--movie-card-->
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-0">
                    <a class="btn btn-danger" href="{{ route('movies.index') }}">More Movies</a>
                </div>
            </div>





            <div class="col-md-2 ">
                <div class="sticky-column">
                    <h6 class="text-center card card-white bg-primary my-2 ubuntu-font py-2 mt-0">
                        <span style="color: azure;">Categories</span>
                    </h6>
                    <div class="container justify-content-center border-left border-right cat-hover">
                        @foreach ($categories as $category)
                            <div class="d-flex justify-content-center py-1">
                                <div class="second py-2 px-2">
                                    <span class="text1 ms-2 ubuntu-font">
                                        <a href="{{ route('categories.show', $category->slug) }}"
                                            style="text-decoration: none;"> <i class="fas fa-folder"></i>
                                            {{ $category->name }}
                                        </a>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <h6 class="text-center card card-white bg-info my-2 mt-2 ubuntu-font py-2">
                        <span style="color: azure;"><a href="{{ route('courses.index') }}"
                                style="text-decoration: none; color:aliceblue;">Popular Courses</a></span>
                    </h6>
                    <h6 class="text-center card card-white bg-warning my-2 mt-2 ubuntu-font py-2">
                        <span style="color: azure;"><a href="{{ route('movies.index') }}"
                                style="text-decoration: none; color:aliceblue;">Download Movies</a></span>
                    </h6>


                </div>
            </div>


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

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    @if (Session::has('success'))
        <script>
            // Show the SweetAlert when the page is loaded
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ Session::get('success') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>
    @endif

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
                    title: 'Share Blog',
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
