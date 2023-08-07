@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="container">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <div class="rounded-circle overflow-hidden" style="height: 150px; width: 150px;">
                                            <img src="{{ asset('storage/' . $user->photo) }}"
                                                alt="{{ $user->name }}'s Photo" class="img-fluid">
                                        </div>
                                        <div class="mt-3">
                                            <h4>{{ $user->name }}</h4>
                                            <p class="text-secondary mb-1">{{ $user->profession }}</p>
                                            <p class="text-muted font-size-sm">{{ $user->address }}</p>
                                            <button class="btn btn-primary">Follow</button>
                                            @if (Auth::check() && Auth::user()->id === $user->id)
                                                <a href="{{ route('users.edit', $user->username) }}"
                                                    class="btn btn-outline-primary">Edit</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i style="color: rgb(8, 157, 244)" class="me-4 fas fa-user"></i>
                                            {{ $user->username }}</h6>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i style="color: rgb(8, 157, 244)"
                                                class="me-4 fas fa-envelope"></i>
                                            <a style="text-decoration: none;"
                                                href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </h6>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i style="color: rgb(8, 157, 244)" class="me-4 fas fa-phone"></i>
                                            <a style="text-decoration: none;"
                                                href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                                        </h6>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i style="color: rgb(8, 157, 244)" class="me-4 fas fa-globe"></i>
                                            <a style="text-decoration: none;" target="_blank"
                                                href="{{ $user->website }}">{{ $user->website }}</a>
                                        </h6>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">
                                            <a href="{{ $user->linkedin }}" target="_blank" style="text-decoration:none;">
                                                <i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fab fa-linkedin"></i>{{ $user->linkedin }}
                                            </a>
                                        </h6>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">
                                            <a href="{{ $user->github }}" target="_blank" style="text-decoration:none;">
                                                <i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fab fa-github"></i>{{ $user->github }}
                                            </a>
                                        </h6>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">
                                            <a href="{{ $user->facebook }}" target="_blank" style="text-decoration:none;">
                                                <i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fab fa-facebook"></i>{{ $user->facebook }}
                                            </a>
                                        </h6>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">
                                            <a href="{{ $user->twitter }}" target="_blank" style="text-decoration:none;">
                                                <i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fab fa-twitter"></i>{{ $user->twitter }}
                                            </a>
                                        </h6>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">
                                            <a href="{{ $user->youtube }}" target="_blank" style="text-decoration:none;">
                                                <i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fab fa-youtube"></i>{{ $user->youtube }}
                                            </a>
                                        </h6>
                                    </li>


                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i style="color: rgb(8, 157, 244)"
                                                class="me-4 fas fa-id-card"></i>
                                            {{ $user->nid }}</h6>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i style="color: rgb(8, 157, 244)"
                                                class="me-4 fas fa-passport"></i>
                                            {{ $user->passport }}</h6>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> User Name :</span></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->username }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Email :</span></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Phone :</span></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->phone }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Website :</span></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->website }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Linkedin :</span>
                                            </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->linkedin }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Git-Hub :</span></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->github }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Facebook :</span>
                                            </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->facebook }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Twitter :</span></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->twitter }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Youtube :</span></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->youtube }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> NID :</span></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->nid }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Passport :</span>
                                            </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->passport }}
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                            </div>

                            <div class="row gutters-sm">
                                <div class="col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="d-flex align-items-center mb-3"><i style="color: rgb(0, 0, 0);"
                                                    class="me-1 fas fa-info-circle"></i>About</h6>
                                            <hr>
                                            <small>{{ $user->about }}</small>
                                        </div>
                                    </div>
                                </div>
                                {{-- @if (Auth::check() && Auth::user()->id === $user->id) --}}
                                <div class="col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="d-flex align-items-center mb-3"><i
                                                    class="material-icons text-info mr-2"></i>{{ $user->name }}'s
                                                recent blogs</h6>
                                            <hr>
                                            <small>
                                                @forelse ($user->blogs as $blog)
                                                    @if ($blog->featured_image)
                                                        <img src="{{ asset($blog->featured_image ? $blog->featured_image : ' ') }}"
                                                            alt="{{ Str::limit($blog->title, 25) }}" class="img-fluid"
                                                            style="border: 2px solid #639c2b9b; border-radius: 10px; height:50px; width:50px">
                                                    @endif
                                                    <a style="text-decoration:none;"
                                                        href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                                @empty
                                                    <p>No blogs found.</p>
                                                @endforelse
                                            </small>

                                        </div>
                                    </div>
                                </div>
                                {{-- @else
                                @endif --}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
