@extends('layouts.app')
@include('partials.meta_static')
@section('content')
    <div class="container">
        @if (Session::has('blog_created_message'))
            <div class="alert alert-success" id="auto-close-alert">
                {{ Session::get('blog_created_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Function to automatically close the alert after 10 seconds
                    function autoCloseAlert() {
                        setTimeout(function() {
                            $("#auto-close-alert").alert("close");
                        }, 5000); // 10 seconds in milliseconds
                    }

                    autoCloseAlert(); // Call the function to start the timer
                });
            </script>
        @endif


        @foreach ($blogs as $blog)
            <div class="blog">
                <h2><a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                        style="text-decoration: none;">{{ ucwords($blog->title) }}</a>
                </h2>
                <a
                    href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"style="text-decoration: none; color:black;">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <!-- Image -->
                            @if ($blog->featured_image)
                                <img src="{{ asset($blog->featured_image ? $blog->featured_image : ' ') }}"
                                    alt="{{ Str::limit($blog->title, 25) }}" width="300" height="220"
                                    style="border: 2px solid #639c2b9b; border-radius: 10px;">
                            @endif
                        </div>
                        <div class="col-md-9 col-12">
                            {!! Str::limit($blog->body, 550) !!}
                        </div>
                    </div>
                </a>
                <div class="flex justify-content-center" style="text-align: right;">
                    @if ($blog->user)
                        Author: <a style="text-decoration:none;"
                            href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }}</a>
                        Posted: {{ $blog->created_at->diffForHumans() }}
                    @endif
                </div>


            </div>
            <hr>
        @endforeach
    </div>
@endsection
