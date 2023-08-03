@extends('layouts.app')
@include('partials.meta_static')
@section('content')
    <div class="container">
        @foreach ($blogs as $blog)
            <div class="blog">
                <div class="row">
                    <div class="flex justify-content-center" style="text-align: right;">
                        @if ($blog->user)
                            <span>
                                <i class="fa-solid fa-user"></i><b>
                                    <a style="text-decoration:none;"
                                        href="{{ route('users.show', $blog->user->username) }}">{{ $blog->user->name }}</a>
                                </b> | <i class="fa-solid fa-file"></i> {{ $blog->created_at->diffForHumans() }} |
                                <i class="fas fa-tags"></i>
                                @foreach ($blog->category as $category)
                                    <span class="category-span">
                                        <a href="{{ route('categories.show', $category->slug) }}"
                                            style="text-decoration:none;">{{ $category->name }}</a>,
                                    </span>
                                @endforeach
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3 col-12">
                        <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                            style="text-decoration: none; color:black;">
                            <!-- Image -->
                            @if ($blog->featured_image)
                                <img src="{{ asset($blog->featured_image ? $blog->featured_image : ' ') }}"
                                    alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
                                    style="border: 2px solid #639c2b9b; border-radius: 10px;">
                            @endif
                        </a>
                    </div>
                    <div class="col-md-9 col-12">
                        <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                            style="text-decoration: none; color:black;">
                            <h2>{{ ucwords($blog->title) }}</h2>
                            {!! Str::limit($blog->body, 550) !!}
                        </a>
                        <br>
                    </div>
                </div>

            </div>
            <hr>
        @endforeach

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
