@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 70px;">
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
                                    @if ($user->username)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fas fa-user"></i>
                                                {{ $user->username }}</h6>
                                        </li>
                                    @endif
                                    @if (Auth::check() && Auth::user()->id === $user->id)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                <i style="color: rgb(8, 157, 244)" class="me-4 fas fa-envelope"></i>
                                                <a style="text-decoration: none;"
                                                    href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                            </h6>
                                        </li>
                                    @endif


                                    @if ($user->phone)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fas fa-phone"></i>
                                                <a style="text-decoration: none;"
                                                    href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                                            </h6>
                                        </li>
                                    @endif
                                    @if ($user->website)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fas fa-globe"></i>
                                                <a style="text-decoration: none;" target="_blank"
                                                    href="{{ $user->website }}">{{ $user->website }}</a>
                                            </h6>
                                        </li>
                                    @endif
                                    @if ($user->linkedin)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                <a href="{{ $user->linkedin }}" target="_blank"
                                                    style="text-decoration:none;">
                                                    <i style="color: rgb(8, 157, 244)"
                                                        class="me-4 fab fa-linkedin"></i>{{ $user->linkedin }}
                                                </a>
                                            </h6>
                                        </li>
                                    @endif
                                    @if ($user->github)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                <a href="{{ $user->github }}" target="_blank"
                                                    style="text-decoration:none;">
                                                    <i style="color: rgb(8, 157, 244)"
                                                        class="me-4 fab fa-github"></i>{{ $user->github }}
                                                </a>
                                            </h6>
                                        </li>
                                    @endif
                                    @if ($user->facebook)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                <a href="{{ $user->facebook }}" target="_blank"
                                                    style="text-decoration:none;">
                                                    <i style="color: rgb(8, 157, 244)"
                                                        class="me-4 fab fa-facebook"></i>{{ $user->facebook }}
                                                </a>
                                            </h6>
                                        </li>
                                    @endif
                                    @if ($user->twitter)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                <a href="{{ $user->twitter }}" target="_blank"
                                                    style="text-decoration:none;">
                                                    <i style="color: rgb(8, 157, 244)"
                                                        class="me-4 fab fa-twitter"></i>{{ $user->twitter }}
                                                </a>
                                            </h6>
                                        </li>
                                    @endif
                                    @if ($user->youtube)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                <a href="{{ $user->youtube }}" target="_blank"
                                                    style="text-decoration:none;">
                                                    <i style="color: rgb(8, 157, 244)"
                                                        class="me-4 fab fa-youtube"></i>{{ $user->youtube }}
                                                </a>
                                            </h6>
                                        </li>
                                    @endif
                                    @if ($user->nid)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fas fa-id-card"></i>
                                                {{ $user->nid }}</h6>
                                        </li>
                                    @endif
                                    @if ($user->passport)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><i style="color: rgb(8, 157, 244)"
                                                    class="me-4 fas fa-passport"></i>
                                                {{ $user->passport }}</h6>
                                        </li>
                                    @endif
                                </ul>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    @if ($user->username)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> User Name :</span>
                                                </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->username }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if (Auth::check() && Auth::user()->id === $user->id)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Email :</span></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if ($user->phone)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Phone :</span>
                                                </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->phone }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if ($user->website)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Website :</span>
                                                </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->website }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if ($user->linkedin)
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
                                    @endif
                                    @if ($user->github)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Git-Hub :</span>
                                                </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->github }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if ($user->facebook)
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
                                    @endif
                                    @if ($user->twitter)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Twitter :</span>
                                                </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->twitter }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if ($user->youtube)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> Youtube :</span>
                                                </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->youtube }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if ($user->nid)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"><span style="color:rgb(51, 51, 58);"> NID :</span></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->nid }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if ($user->passport)
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
                                    @endif
                                </div>
                            </div>
                            @if ($user->about)
                                <div class="col-sm-12 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="d-flex align-items-center mb-3"><i style="color: rgb(0, 0, 0);"
                                                    class="me-1 fas fa-info-circle"></i>About</h6>
                                            <hr>
                                            <small>{{ $user->about }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- @if (Auth::check() && Auth::user()->id === $user->id) --}}
                            @if ($user->blogs->isNotEmpty())
                                <div class="col-sm-12 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="d-flex align-items-center mb-3"><i
                                                    class="material-icons text-info mr-2"></i>{{ $user->name }}'s
                                                recent blogs</h6>
                                            <hr>
                                            <div class="container justify-content-center border-left border-right">
                                                @foreach ($user->blogs as $blog)
                                                    <div class="d-flex py-1">
                                                        <div class="second py-2 px-2">
                                                            <span class="text1 ms-2 ubuntu-font">
                                                                @if ($blog->featured_image)
                                                                    <img src="{{ asset($blog->featured_image ? $blog->featured_image : ' ') }}"
                                                                        alt="{{ Str::limit($blog->title, 25) }}"
                                                                        class="img-fluid"
                                                                        style="border: 2px solid #639c2b9b; border-radius: 10px; height:50px; width:50px">
                                                                @endif
                                                                <a href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                                                    style="text-decoration: none;">
                                                                    {{ $blog->title }}
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- @else
                                @endif --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
