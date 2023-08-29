@extends('layouts.app')
@include('partials.meta_dynamic')
@section('content')
    <div class="container" style="padding-top: 70px;">

        {{-- Category dropdown menu --}}
        <div class="position-fixed top-0 end-0 mt-4 me-4" style="padding-top: 70px; z-index: 1000;"> {{-- Add z-index --}}
            {{-- Category dropdown menu --}}
            <div class="btn-group dropend">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-folder"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                    @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('categories.show', $category->slug) }}">
                            <i class="fas fa-file text-primary"></i> {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>



        <div class="card card-white post mt-2 mb-4">
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
                            <h2>{{ ucwords($blog->title) }}</h2> <br>
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
                <div class="card-footer d-flex justify-content-between align-items-center">

                    @if (Auth::user())
                        @if (Auth::user()->role_id === 1 || (Auth::user()->role_id === 2 && Auth::user()->id === $blog->user_id))
                            <div class="d-flex align-items-center m-2">
                                <a href="{{ route('blogs.edit', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                    type="button" class="btn btn-success me-2">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger delete-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endif

                    <span class="text-danger">
                        <i class="fas fa-eye me-1"></i> {{ $blog->view_count }}
                    </span>

                    <span class="text-primary">
                        <i class="fas fa-comment-dots"></i> {{ $blog->comments->count() }}
                    </span>

                    <button class="btn btn-secondary share-button"
                        data-url="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
                        <i class="fas fa-share"></i> Share
                    </button>
                </div>


            </div>

            <?php
            // Increment the view count of the blog post
            $blog->increment('view_count');
            ?>

        </div>

        <!-- ... existing comments ... -->

        <div class="mt-3">

            <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary position-relative">
                    <h6>Comments</h6>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $blog->comments->count() }}
                    </span>
                </button>


            </div>


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

        <div class="mb-2 mt-2 ubuntu-font p-2 "
            style="text-align: center; background-color: rgb(255, 255, 255); border-radius: 8px;">
            <h3 class="text-danger"><b>You May Like</b></h3>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @php
                $shuffledBlogs = $blogshow->shuffle()->take(6);
            @endphp

            @foreach ($shuffledBlogs as $blog)
                <div class="col">
                    <div class="card h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">

                        @if ($blog->featured_image)
                            <img class="card-img-top" src="{{ asset($blog->featured_image) }}"
                                alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
                                style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                        @else
                            <!-- Placeholder image when featured image is empty -->
                            <img class="card-img-top" src="{{ asset('images/empty.png') }}"
                                alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
                                style="border: 2px solid #e3e9de9b; border-radius: 10px; height:200px; width:auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title text-lg fw-bold text-dark">
                                {{ Str::limit(ucwords($blog->title), 30) }}</h5>
                            <p>{!! Str::limit(app('purifier')->clean($blog->body, ['HTML.Allowed' => 'p,strong,i,em']), 100) !!}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                class="btn btn-primary">Read More</a>
                            <span class="text-info">
                                <i class="fas fa-comment-dots"></i> {{ $blog->comments->count() }}
                            </span>

                            <span class="text-danger">
                                <i class="fas fa-eye me-1"></i> {{ $blog->view_count }}
                            </span>

                            <button class="btn btn-secondary share-button"
                                data-url="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
                                <i class="fas fa-share"></i> Share
                            </button>
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
