@extends('layouts.app')
@include('partials.meta_static')
@section('content')
    <div class="container" style="padding-top: 70px;">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('blogs.search') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search courses...">
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

                {{-- most viewed part  --}}
                <div class="mb-2 ubuntu-font p-2"
                    style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
                    <h3><b>Popular Courses</b></h3>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($courses as $course)
                        <div class="col">
                            <div
                                class="card h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">

                                @if ($course->image)
                                    <img class="card-img-top" src="{{ asset($course->image) }}"
                                        alt="{{ Str::limit($course->title, 25) }}" class="img-fluid"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
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

                                    {{-- <!-- Replace this with the appropriate count for courses -->
                                <span class="text-info">
                                    <i class="fas fa-comment-dots"></i> {{ $course->comments_count }}
                                </span>
                
                                <!-- Replace this with the appropriate view count for courses -->
                                <span class="text-danger">
                                    <i class="fas fa-eye me-1"></i> {{ $course->view_count }}
                                </span> --}}

                                    <!-- Replace this with the appropriate share URL for courses -->
                                    {{-- <button class="btn btn-secondary share-button"
                                        data-url="{{ route('courses.show', ['id' => $course->id, 'slug' => $course->slug]) }}">
                                        <i class="fas fa-share"></i> Share
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
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
