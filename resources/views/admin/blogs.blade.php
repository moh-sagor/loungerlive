@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron text-center bg-secondary form-control mb-1">
                <h1 class="display-6">Manage Blogs</h1>
            </div>
            <div class="col-md-6">
                <div class="jumbotron text-center bg-light form-control">
                    <h1 class="display-6">Published Blogs</h1>
                </div>
                @if ($publishedBlogs->isEmpty())
                    <div class="text-center">No published blogs available.</div>
                @else
                    @foreach ($publishedBlogs as $blog)
                        <div style="display: flex; align-items: center;" class="mt-1">
                            <div style="flex: 9;">
                                <h5>
                                    <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                        style="text-decoration: none;">{{ $blog->title }}</a>
                                    <p>{!! Str::limit($blog->body, 50) !!}</p>
                                </h5>
                            </div>
                            <div style="flex: 2;">
                                <form action="{{ route('blogs.toggle-status', ['id' => $blog->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-warning mb-2" type="submit">Save as Draft</button>
                                </form>

                            </div>
                        </div>

                        {{-- {!! Str::limit($blog->body, 100) !!} --}}
                    @endforeach
                    {{ $publishedBlogs->links() }}
                @endif
            </div>
            <div class="col-md-6">
                <div class="jumbotron text-center bg-light form-control">
                    <h1 class="display-6">Drafted Blogs</h1>
                </div>
                @if ($draftBlogs->isEmpty())
                    <div class="text-center">No Drafted blogs available.</div>
                @else
                    @foreach ($draftBlogs as $blog)
                        <div style="display: flex; align-items: center;" class="mt-1">
                            <div style="flex: 9;">
                                <h5><a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                        style="text-decoration: none;">{{ $blog->title }}</a></h5>
                            </div>
                            <div style="flex: 2;">
                                <form action="{{ route('blogs.toggle-status', ['id' => $blog->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-primary mb-2" type="submit">Save as Published</button>
                                </form>

                            </div>
                        </div>

                        {{-- {!! Str::limit($blog->body, 100) !!} --}}
                    @endforeach
                    {{ $draftBlogs->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
