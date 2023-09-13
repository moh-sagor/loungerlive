@extends('layouts.app')
@include('partials.meta_static')
@section('content')
    <style>
        .card {
            transition: transform 0.2s;
            /* Add a smooth transition for the transform property */
        }

        .card:hover {
            transform: scale(1.02);
            /* Zoom in on hover */
        }
    </style>
    <div class="container" style="padding-top: 70px;">
        <div class="row">
            <div class="col-md-10">
                <form action="{{ route('blogs.search') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search blogs...">
                        <button type="submit" class="btn btn-primary ubuntu-font">Search</button>
                    </div>
                </form>

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

                @if (Session::has('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '{{ Session::get('error') }}',
                        });
                    </script>
                @endif

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

            </div>

            <div class="col-md-2">
                <div class="sticky-column">
                    <h6 class="text-center card card-white bg-primary my-2 ubuntu-font py-2 mt-0">
                        <span style="color: azure;">Categories</span>
                    </h6>
                    <div class="container justify-content-center border-left border-right">
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

            <div class="container">
                <div class="d-flex justify-content-center mt-4">
                    {{ $blogs->links() }}
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
