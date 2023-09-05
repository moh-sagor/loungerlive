@extends('adminPanel.mainpage')
@section('main')
    @include('partials.tinymce')
    <div class="container" style="padding-top: 70px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </nav>
        <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
            <h1 class="display-4">Edit the blog | {{ Str::limit($blog->title, 25) }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ $blog->title }}">
                    </div>

                    <div class="form-group">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control my-editor" id="body" name="body" rows="5">{{ $blog->body }}</textarea>
                    </div>
                    <div class="form-group form-check-inline">
                        <label for="category" class="form-label mt-4">Select Category</label><br>

                        <span class="text-primary"
                            style="font-weight: bold;">{{ $blog->category->count() ? 'Current Categories ' : '' }}
                            &nbsp;</span>
                        @foreach ($blog->category as $category)
                            <input type="checkbox" id="category_{{ $category->id }}" name="category_id[]"
                                value="{{ $category->id }}" checked>
                            <label class="form-check-label mr-2"
                                for="category_{{ $category->id }}"><b>{{ $category->name }}</b></label>
                        @endforeach
                    </div>
                    <div class="form-group form-check-inline">
                        @if ($filtered->count() > 0)
                            <span class="text-danger" style="font-weight: bold;">Available Categories &nbsp; </span>
                            @foreach ($filtered as $category)
                                <input type="checkbox" id="category_{{ $category->id }}" name="category_id[]"
                                    value="{{ $category->id }}">
                                <label class="form-check-label mr-2"
                                    for="category_{{ $category->id }}"><b>{{ $category->name }}</b></label>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-6 form-group mt-3">
                        <label class="form-label" for="featured_image">Featured Image</label>
                        <input type="file" class="form-control" id="featured_image" name="featured_image" />
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Update Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
