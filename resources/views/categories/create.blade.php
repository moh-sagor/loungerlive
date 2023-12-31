@extends('adminPanel.mainpage')
@section('main')
    <div class="container" style="padding-top: 10px;">
        <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
            <h1 class="display-4">Create a Category</h1>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="form-border mt-2">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter name">
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary">Create New Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
