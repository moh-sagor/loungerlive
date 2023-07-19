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
            <h2><a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                    style="text-decoration: none;">{{ $blog->title }}</a>
            </h2>
            {!! $blog->body !!}
            @if ($blog->user)
                Author: <a style="text-decoration:none;"
                    href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }}</a>
                Posted : {{ $blog->created_at->diffForHumans() }}
            @endif
            <hr>
        @endforeach
    </div>
@endsection
