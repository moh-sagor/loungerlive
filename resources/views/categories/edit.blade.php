@extends('layouts.app')
@section('content')
    <div class="container offset-md-2" style="padding-top: 70px;">
        <div class="jumbotron text-center bg-light form-control">
            <h1 class="display-4">Edit the Category</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $category->name }}">
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
