@extends('layouts.app')
@include('partials.meta_dynamic')
@section('content')
    <style>
        .card-v {
            transition: transform 0.2s;
            /* Add a smooth transition for the transform property */
        }

        .card-v:hover {
            transform: scale(1.02);
            /* Zoom in on hover */
        }

        /* Add any other custom styling as needed */
        .vr {
            border-left: 2px solid #0400ff;
            height: auto;
            margin: 0 5px;
        }

        .glow-on-hover {
            width: 400px;
            height: 50px;
            border: none;
            outline: none;
            color: #fff;
            font-size: 25px;
            background: #111;
            cursor: pointer;
            position: relative;
            z-index: 0;
            border-radius: 10px;
        }

        .glow-on-hover:after {
            content: '';
            background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
            position: absolute;
            top: -2px;
            left: -2px;
            background-size: 400%;
            z-index: -1;
            filter: blur(5px);
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: glowing 20s linear infinite;
            opacity: 1;
            /* Set opacity to 1 to make it always visible */
            border-radius: 10px;
        }

        .glow-on-hover:active {
            color: #000;
        }

        .glow-on-hover:active:before {
            background: transparent;
        }

        .glow-on-hover:before {
            z-index: -1;
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: #111;
            left: 0;
            top: 0;
            border-radius: 10px;
        }

        @keyframes glowing {
            0% {
                background-position: 0 0;
            }

            50% {
                background-position: 400% 0;
            }

            100% {
                background-position: 0 0;
            }
        }
    </style>


    <div class="container" style="padding-top: 70px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </nav>

        {{-- Category dropdown menu --}}
        <div class="position-fixed top-0 end-0 mt-4 me-4" style="padding-top: 70px; z-index: 1000;"> {{-- Add z-index --}}
            {{-- Category dropdown menu --}}
            <div class="btn-group dropend">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
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



                @if (Auth::user() &&
                        (Auth::user()->role_id === 1 || (Auth::user()->role_id === 2 && Auth::user()->id === $blog->user_id)))
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="d-flex justify-content-start">

                                    <a href="{{ route('blogs.edit', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                        type="button" class="btn btn-success me-2">Edit</a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }} " method="POST">
                                        @csrf
                                        <button class="btn btn-danger delete-btn" type="submit">Delete</button>
                                    </form>

                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="d-flex justify-content-end">
                                    @php
                                        $blog->increment('view_count');
                                    @endphp
                                    <span class="text-danger me-3">
                                        <i class="fas fa-eye me-1"></i>{{ $blog->view_count }}
                                    </span>
                                    <div class="vr me-2"></div>
                                    <span class="me-3">
                                        <i class="fas fa-comment-dots"></i> {{ $blog->comments->count() }}
                                    </span>
                                    <div class="vr me-2"></div>
                                    <button class="btn btn-secondary share-button"
                                        data-url="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
                                        <i class="fas fa-share"></i> Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card-footer">
                        <div class="col-md-12 col-12">
                            <div class="d-flex justify-content-center">
                                @php
                                    $blog->increment('view_count');
                                @endphp
                                <span class="text-danger me-3">
                                    <i class="fas fa-eye me-1"></i>{{ $blog->view_count }}
                                </span>
                                <div class="vr me-2"></div>
                                <span class="me-3">
                                    <i class="fas fa-comment-dots"></i> {{ $blog->comments->count() }}
                                </span>
                                <div class="vr me-2"></div>
                                <button class="btn btn-secondary share-button"
                                    data-url="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
                                    <i class="fas fa-share"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>


            <?php
            // Increment the view count of the blog post
            $blog->increment('view_count');
            ?>

        </div>

        {{-- button  --}}

        <div class="container d-flex justify-content-center">
            <a href="{{ $blog->link }}" class="glow-on-hover btn" target="_blank">{{ $blog->btn_name }}</a>
        </div>

        <!-- ... (existing content) ... -->

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
                <div class="card card-v mt-3 mb-3">
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

            <!-- Display comments with pagination -->
            @if ($blog->comments->count() > 0)
                <div class="comments mt-3">
                    @foreach ($blog->comments->reverse() as $comment)
                        <div class="card card-v p-3 mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center">
                                    @if ($comment->user && $comment->user->photo)
                                        <img src="{{ asset('storage/' . $comment->user->photo) }}"
                                            class="rounded-circle m-2" style="width: 50px;" alt="Avatar" />
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

                <!-- Add pagination links -->
            @else
                <p class="card card-v p-3 mt-2">No comments yet.</p>
            @endif
        </div>



        {{-- you may like  --}}

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
                    <div
                        class="card card-v h-100 border border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">

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
                            <div class="vr me-2"></div>
                            <span class="text-info">
                                <i class="fas fa-comment-dots"></i> {{ $blog->comments->count() }}
                            </span>
                            <div class="vr me-2"></div>

                            <span class="text-danger">
                                <i class="fas fa-eye me-1"></i> {{ $blog->view_count }}
                            </span>
                            <div class="vr me-2"></div>
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
@endsection
