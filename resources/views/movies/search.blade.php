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

        .header-icon {
            width: 100%;
            height: 367px;
            line-height: 367px;
            text-align: center;
            vertical-align: middle;
            margin: 0 auto;
            color: #ffffff;
            font-size: 54px;
            text-shadow: 0px 0px 20px #6abcea, 0px 5px 20px #6ABCEA;
            opacity: .85;
        }

        .header-icon:hover {
            font-size: 74px;
            text-shadow: 0px 0px 20px #6abcea, 0px 5px 30px #6ABCEA;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            opacity: 1;
        }
    </style>
    <div class="container" style="padding-top: 70px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('movies.index') }}">Movies</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $query }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-10">
                <!-- Display Search Results If Query Is Present -->
                @if (isset($query) && $movies->count() > 0)
                    <div class="mb-2 ubuntu-font p-2"
                        style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
                        <h3><b>Search Results for <span class="text-danger">"{{ $query }}"</span></b></h3>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 g-4 mb-2">
                        @foreach ($movies as $movie)
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
                    {{ $movies->links() }} <!-- Pagination links -->
                @endif
            </div>

            {{-- you may like  --}}
            <div class="col-md-2 col-12 mt-0">
                <div class="mb-2 mt-0 ubuntu-font p-2 "
                    style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
                    <h5 class="text-primary"><b>You May Like</b></h5>
                </div>
                @php
                    $shuffledmovies = $allmovie->shuffle()->take(25);
                @endphp

                @foreach ($shuffledmovies as $movie)
                    <div class="row mt-2">
                        <div class="col-md-2 col-sm-2 col-2 d-flex justify-content-center align-items-center ">
                            @if ($movie->image)
                                <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                    <img class="card-img-top justify-content-center rounded-circle"
                                        src="{{ asset($movie->image) }}" alt="{{ Str::limit($movie->title, 25) }}"
                                        style="border: 2px solid #e3e9de9b; border-radius: 50%; height:50px; width:50px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                </a>
                            @else
                                <!-- Placeholder image when featured image is empty -->
                                <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                    <img class="card-img-top" src="{{ asset('images/empty.png') }}"
                                        alt="{{ Str::limit($movie->title, 25) }}"
                                        style="border: 2px solid #e3e9de9b; border-radius: 50%; height:50px; width:50px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                </a>
                            @endif
                        </div>
                        <div class="col-md-10 col-sm-10 col-10 ">
                            <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}"
                                style="text-decoration: none;">
                                <p class="p-2 card-title text-lg fw-bold text-dark"
                                    style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
                                    {{ Str::limit(ucwords($movie->title), 30) }}</p>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col d-flex justify-content-center me-2">
                        <div
                            class="card h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden p-2">

                            <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}"
                                style="text-decoration: none;">
                                <h5 class="p-2 card-title text-lg fw-bold text-dark">
                                    {{ Str::limit(ucwords($movie->title), 30) }}</h5>
                            </a>

                            @if ($movie->image)
                                <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                    <img class="card-img-top justify-content-center" src="{{ asset($movie->image) }}"
                                        alt="{{ Str::limit($movie->title, 25) }}"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:100px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                </a>
                            @else
                                <!-- Placeholder image when featured image is empty -->
                                <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                                    <img class="card-img-top" src="{{ asset('images/empty.png') }}"
                                        alt="{{ Str::limit($movie->title, 25) }}"
                                        style="border: 2px solid #e3e9de9b; border-radius: 10px; height:100px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                </a>
                            @endif
                        </div>
                    </div> --}}
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
                    title: 'Share movie',
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
