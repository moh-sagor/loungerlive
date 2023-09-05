@extends('layouts.app')
@include('partials.meta_static')
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

        /* Add any other custom styling as needed */
        .vr {
            border-left: 2px solid #0400ff;
            height: auto;
            margin: 0 5px;
        }
    </style>
    <div class="container" style="padding-top: 70px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('courses.index') }}">Courses</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $query }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-10">
                <!-- Display Search Results If Query Is Present -->
                @if (isset($query) && $courses->count() > 0)
                    <div class="mb-2 ubuntu-font p-2"
                        style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
                        <h3><b>Search Results for <span class="text-danger">"{{ $query }}"</span></b></h3>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 g-4 mb-2">
                        @foreach ($courses as $course)
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
                    {{ $courses->links() }} <!-- Pagination links -->
                @endif
            </div>

            {{-- you may like  --}}
            <div class="col-md-2 col-12 mt-0">
                <div class="mb-2 mt-0 ubuntu-font p-2 "
                    style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
                    <h3 class="text-primary"><b>You May Like</b></h3>
                </div>
                @php
                    $shuffledcourses = $allcourse->shuffle()->take(6);
                @endphp

                @foreach ($shuffledcourses as $course)
                    <div class="col d-flex justify-content-center me-2">
                        <div
                            class="card h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden p-2">

                            <a href="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}"
                                style="text-decoration: none;">
                                <h5 class="p-2 card-title text-lg fw-bold text-dark">
                                    {{ Str::limit(ucwords($course->title), 30) }}</h5>
                            </a>

                            @if ($course->image)
                                <a href="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}">
                                    <img class="card-img-top justify-content-center" src="{{ asset($course->image) }}"
                                        alt="{{ Str::limit($course->title, 25) }}"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:100px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                </a>
                            @else
                                <!-- Placeholder image when featured image is empty -->
                                <a href="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}">
                                    <img class="card-img-top" src="{{ asset('images/empty.png') }}"
                                        alt="{{ Str::limit($course->title, 25) }}"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:100px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <a href="#" class="go-to-home">
                <i class="fas fa-home"></i>
            </a>
        </div>
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
