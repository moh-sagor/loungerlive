@extends('adminPanel.mainpage')
@section('main')
    <div class="container" style="padding-top: 10px;">
        @include('partials.tinymce')
        <div class="container"style="padding-top: 10px;">
            <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
                <h1 class="display-4">Create a new courses</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('courses.update', $courses->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.error')
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $courses->title }}">
                        </div>
                        <div class="form-group">
                            <label for="instructor" class="form-label">Instructor</label>
                            <input type="text" class="form-control" id="instructor" name="instructor"
                                value="{{ $courses->instructor }}">
                        </div>
                        <div class="form-group">
                            <label for="course_author" class="form-label">Course_author</label>
                            <input type="text" class="form-control" id="course_author" name="course_author"
                                value="{{ $courses->course_author }}">
                        </div>

                        <div class="form-group">
                            <label for="body" class="form-label">Course Body</label>
                            <textarea name="body" id="body" class="form-control my-editor">{{ $courses->body }}</textarea>

                        </div>

                        <div class="col-md-6 form-group mt-3">
                            <label class="form-label" for="image">Course Banner</label>
                            <input type="file" class="form-control" id="image" name="image" />
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
