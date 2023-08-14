@extends('layouts.app')
@include('partials.meta_static')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <form action="{{ route('blogs.search') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search blogs...">
                        <button type="submit" class="btn btn-primary">Search</button>
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




                @foreach ($blogs as $blog)
                    <div class="card card-white post mt-2">
                        <div class="card-header post-heading d-flex">
                            <div class="float-start image">
                                @if ($blog->user && $blog->user->photo)
                                    <img src="{{ asset('storage/' . $blog->user->photo) }}"
                                        class="img-fluid rounded-circle avatar" alt="user profile image">
                                @else
                                    <img src="{{ asset('images/default-profile.jpg') }}"
                                        class="img-fluid rounded-circle avatar" alt="default profile image">
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
                                    <p style="text-align: justify;">{!! Str::limit($blog->body, 500) !!}</p>
                                    <a class="btn btn-light rounded-pill mx-1 title h5 category-span"
                                        href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                        style="text-decoration: none; color: #555;">
                                        ...........Read More
                                    </a>

                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="container">
                    <div class="d-flex justify-content-center mt-4">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>




            <div class="col-md-2 card card-white">
                <div class="d-flex justify-content-end mt-4">
                    {{ $blogs->links() }}
                </div>
                <hr>
                <h5 class="text-center card card-white mt-2 bg-primary my-2">Categories</h5>
                <div class="container justify-content-center border-left border-right">
                    @foreach ($categories as $category)
                        <div class="d-flex justify-content-center py-2">
                            <div class="second py-2 px-2">
                                <span class="text1">
                                    <a href="{{ route('categories.show', $category->slug) }}"
                                        style="text-decoration: none;">
                                        {{ $category->name }}
                                    </a>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

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
@endsection
