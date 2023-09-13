@extends('adminPanel.mainpage')
@section('main')
    <div class="container" style="padding-top: 10px;">
        @include('partials.tinymce')
        <div class="container"style="padding-top: 10px;">
            <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
                <h1 class="display-4">Create a new movies</h1>
            </div>

            <div class="row">
                <div class="col-md-12 ">
                    <div class="form-border mt-2">
                        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @include('partials.error')
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Movies title">
                            </div>
                            <div class="form-group">
                                <label for="year" class="form-label">Release Year </label>
                                <input type="text" class="form-control" id="year" name="year"
                                    placeholder="Enter Movie Release Year">
                            </div>
                            <div class="form-group">
                                <label for="actors" class="form-label">Actors</label>
                                <input type="text" class="form-control" id="actors" name="actors"
                                    placeholder="Enter Actors. separate by comma">
                            </div>
                            <div class="form-group">
                                <label for="producer" class="form-label">Producer</label>
                                <input type="text" class="form-control" id="producer" name="producer"
                                    placeholder="Enter Producer">
                            </div>
                            <div class="form-group">
                                <label for="link" class="form-label">Download Link</label>
                                <input type="text" class="form-control" id="link" name="link"
                                    placeholder="Enter Download Link">
                            </div>

                            <div class="form-group">
                                <label for="body" class="form-label">Movie Body</label>
                                <textarea name="body" id="body" class="form-control my-editor" placeholder="Enter body"></textarea>

                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label class="form-label" for="image">Movie Banner</label>
                                <input type="file" class="form-control" id="image" name="image" />
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary">Create New Movies</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
