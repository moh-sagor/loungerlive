@extends('layouts.app')
@include('partials.meta_static')
@section('content')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="movie-form">
                <form action="{{ route('movies.search') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <!-- Update the input field name to 'query' -->
                        <input type="text" class="form-control" name="query" placeholder="Search movies..."
                            value="{{ $query ?? '' }}">
                        <button type="submit" class="btn btn-primary ubuntu-font">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
    @include('movies.jsandcss')
    <div class="container-movie">
        @foreach ($movies as $movie)
            <div class="movie-card">
                <div class="movie-header"
                    style="background:url({{ asset($movie->image) }}); background-size: cover;
                    background-position: 100% 100%;">
                    <div class="header-icon-container">
                        <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
                            <i class="material-icons header-icon"></i>
                        </a>
                    </div>
                </div><!--movie-header-->
                <div class="movie-content">
                    <div class="movie-content-header">
                        <a href="{{ route('movies.show', ['id' => $movie->id, 'slug' => $movie->slug]) }}">
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
                            <span> <i class="fas fa-user-friends"></i> {{ Str::limit(ucwords($movie->actors), 70) }}</span>
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

        <div class="container">
            <div class="d-flex justify-content-center mt-4">
                {{ $movies->links() }}
            </div>
        </div>

        <a href="#" class="go-to-home">
            <i class="fas fa-home"></i>
        </a>
    </div><!--container-->


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
                    title: 'Share Course',
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
