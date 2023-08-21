@extends('adminPanel.mainpage')
@section('main')
    <div class="container" style="padding-top: 10px;">
        <div class="jumbotron text-center bg-light form-control ubuntu-font text-white">
            <h1 class="display-6">Manage Blogs</h1>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="text-center bg-light form-control">
                    <h1 class="display-6">Published Blogs</h1>
                </div>
                <div class="container border-left border-right">
                    <div class="d-flex py-1">
                        <div class="second py-2 px-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serialNumber = 1;
                                    @endphp
                                    @forelse ($publishedBlogs as $blog)
                                        <tr>
                                            <td>{{ $serialNumber }}</td>
                                            <td>
                                                <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                                    style="text-decoration: none;">
                                                    {{ Str::limit($blog->title, 50) }}
                                                </a>
                                            </td>
                                            <td>{!! Str::limit($blog->body, 100) !!}</td>
                                            <td>
                                                <form action="{{ route('blogs.toggle-status', ['id' => $blog->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-warning mb-2" type="submit">Save as
                                                        Draft</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $serialNumber++;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No published blogs available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if ($publishedBlogs->isNotEmpty())
                                {{ $publishedBlogs->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6 col-12">
                <div class="text-center bg-light form-control">
                    <h1 class="display-6">Drafted Blogs</h1>
                </div>
                <div class="container border-left border-right">
                    <div class="d-flex py-1">
                        <div class="second py-2 px-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serialNumber = 1;
                                    @endphp
                                    @forelse ($draftBlogs as $blog)
                                        <tr>
                                            <td>{{ $serialNumber }}</td>
                                            <td>
                                                <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                                    style="text-decoration: none;">
                                                    {{ Str::limit($blog->title, 50) }}
                                                </a>
                                            </td>
                                            <td>{!! Str::limit($blog->body, 100) !!}</td>
                                            <td>
                                                <form action="{{ route('blogs.toggle-status', ['id' => $blog->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-primary mb-2" type="submit">Save as
                                                        Published</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $serialNumber++;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No Drafted blogs available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if ($draftBlogs->isNotEmpty())
                                {{ $draftBlogs->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
