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
                        <div class="col-md-6 col-sm-6">
                            <div class="d-flex">
                                <form action="{{ route('blogs.restore', ['id' => $trash->id, 'slug' => $trash->slug]) }}"
                                    method="GET">
                                    @csrf
                                    <button class="btn btn-primary restore-btn me-2" type="button">Restore</button>
                                </form>

                                <a class="btn btn-danger btn-sm delete-parmanently"
                                    href="{{ route('blogs.parmanent-delete', ['id' => $trash->id, 'slug' => $trash->slug]) }}"
                                    data-id="{{ $trash->id }}" data-slug="{{ $trash->slug }}">Delete Permanently</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>
    <script>
        const deleteButtons = document.querySelectorAll('.delete-parmanently');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const dataHref = this.getAttribute('href');
                const id = this.getAttribute('data-id');
                const slug = this.getAttribute('data-slug');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = dataHref;
                    }
                });
            });
        });

        // SweetAlert for Restore
        const restoreButtons = document.querySelectorAll('.restore-btn');
        restoreButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Restore this blog?',
                    text: 'This blog will be restored.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Restore'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Trigger the form submission when confirmed
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
