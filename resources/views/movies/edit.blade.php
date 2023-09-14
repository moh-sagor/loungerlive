@extends('adminPanel.mainpage')
@section('main')
    @include('partials.tinymce')
    <div class="container"style="padding-top: 10px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('movies.index') }}">movies</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{ route('movies.show', ['id' => $movies->id, 'slug' => $movies->slug]) }}">Show</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $movies->title }}</li>
            </ol>
        </nav>
        <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
            <h1 class="display-4">Edit Movie</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-border mt-2">
                    <form action="{{ route('movies.update', $movies->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.error')
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $movies->title }}">
                        </div>
                        <div class="form-group">
                            <label for="year" class="form-label">Release Year</label>
                            <input type="text" class="form-control" id="year" name="year"
                                value="{{ $movies->year }}">
                        </div>
                        <div class="form-group">
                            <label for="actors" class="form-label">Actors</label>
                            <input type="text" class="form-control" id="actors" name="actors"
                                value="{{ $movies->actors }}">
                        </div>
                        <div class="form-group">
                            <label for="producer" class="form-label">Producer</label>
                            <input type="text" class="form-control" id="producer" name="producer"
                                value="{{ $movies->producer }}">
                        </div>
                        <div class="form-group">
                            <label for="link" class="form-label">Download Link</label>
                            <input type="text" class="form-control" id="link" name="link"
                                value="{{ $movies->link }}">
                        </div>

                        <div class="form-group">
                            <label for="body" class="form-label">Movie Body</label>
                            <textarea name="body" id="body" class="form-control my-editor">{{ $movies->body }}</textarea>

                        </div>

                        <div class="col-md-6 form-group mt-3">
                            <label class="form-label" for="image">Movie Banner</label>
                            <input type="file" class="form-control" id="image" name="image" />
                        </div>



                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Movie</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
