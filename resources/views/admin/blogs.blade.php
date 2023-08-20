@extends('adminPanel.mainpage')
@section('main')
    <div class="container" style="padding-top: 70px;">
        <div class="row">
            <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
                <h1 class="display-6">Manage Blogs</h1>
            </div>
            <div class="col-md-6">
                <div class="text-center bg-light form-control">
                    <h1 class="display-6">Published Blogs</h1>
                </div>

                <div class="container border-left border-right">
                    <div class="d-flex py-1">
                        <div class="second py-2 px-2">
                            <span class="text1 ms-2 ubuntu-font">
                                @if ($publishedBlogs->isEmpty())
                                    <div class="text-center">No published blogs available.</div>
                                @else
                                    @foreach ($publishedBlogs as $blog)
                                        <div style="display: flex; align-items: center;" class="mt-1">
                                            <div style="flex: 9;">
                                                <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                                    style="text-decoration: none;">
                                                    <h5>{{ Str::limit($blog->title, 50) }}</h5>
                                                </a>
                                                <p>{!! Str::limit($blog->body, 100) !!}</p>
                                            </div>
                                            <div style="flex: 2;">
                                                <form action="{{ route('blogs.toggle-status', ['id' => $blog->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-warning mb-2" type="submit">Save as
                                                        Draft</button>
                                                </form>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    {{ $publishedBlogs->links() }}
                                @endif

                            </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class=" text-center bg-light form-control">
                    <h1 class="display-6">Drafted Blogs</h1>
                </div>
                <div class="container border-left border-right">
                    <div class="d-flex py-1">
                        <div class="second py-2 px-2">
                            <span class="text1 ms-2 ubuntu-font">
                                @if ($draftBlogs->isEmpty())
                                    <div class="text-center">No Drafted blogs available.</div>
                                @else
                                    @foreach ($draftBlogs as $blog)
                                        <div style="display: flex; align-items: center;" class="mt-1">
                                            <div style="flex: 9;">
                                                <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                                    style="text-decoration: none;">
                                                    <h5>{{ Str::limit($blog->title, 50) }}</h5>
                                                </a>
                                                <p>{!! Str::limit($blog->body, 100) !!}</p>
                                            </div>
                                            <div style="flex: 2;">
                                                <form action="{{ route('blogs.toggle-status', ['id' => $blog->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-primary mb-2" type="submit">Save as
                                                        Published</button>
                                                </form>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    {{ $draftBlogs->links() }}
                                @endif

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
