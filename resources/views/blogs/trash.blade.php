@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron text-center bg-light form-control mb-2">
            <h1 class="display-4">Restore the blog</h1>
        </div>
        @foreach ($trashedBlogs as $trash)
            <div class="row">
                <div class="col-md-3 col-12">
                    @if ($trash->featured_image)
                        <img src="{{ asset($trash->featured_image ? $trash->featured_image : ' ') }}"
                            alt="{{ Str::limit($trash->title, 25) }}" width="300" height="220"
                            style="border: 2px solid #639c2b9b; border-radius: 10px;">
                    @endif
                </div>
                <div class="col-md-9 col-12">
                    <h2><a href="{{ route('blogs.show', ['id' => $trash->id, 'slug' => $trash->slug]) }}"
                            style="text-decoration: none;">{{ $trash->title }}</a>
                    </h2>
                    <p>{!! Str::limit($trash->body, 200) !!}</p>
                    <div class="row">
                        @if (isset($trash) && $trash)
                            <div class="col-md-6 col-sm-6">
                                <div class="d-flex">
                                    <a class="btn btn-danger btn-sm me-2"
                                        href="{{ route('blogs.parmanent-delete', ['id' => $trash->id, 'slug' => $trash->slug]) }}">Delete
                                        Permanently</a>

                                    <form
                                        action="{{ route('blogs.restore', ['id' => $trash->id, 'slug' => $trash->slug]) }}"
                                        method="get">
                                        @csrf
                                        <button class="btn btn-primary" type="submit">Restore</button>
                                    </form>

                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <p>No data to restore.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>




            <hr>
        @endforeach

    </div>
@endsection
