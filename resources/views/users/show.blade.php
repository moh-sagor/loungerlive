@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-3 col-12 border rounded border-success">
            <h3 class="d-flex justify-content-center">Hello, {{ $user->name }}</h3>
            <hr>
            <div class=" d-flex justify-content-center">
                <div class="rounded-circle overflow-hidden" style="height: 120px; width: 120px;">
                    <img src="{{ asset('storage/' . $user->photo) }}" class="img-fluid" alt="User Photo">
                </div>
            </div>
            <h5 class="mt-2"><i style="color: red" class="fas fa-user"></i><span style="color:blue;"> User Name
                    :</span>
                {{ $user->username }}</h5>
            <h5><i style="color: red" class="fas fa-envelope"></i><span style="color:blue;"> Email :</span>
                {{ $user->email }}</h5>
            <h5><i style="color: red" class="fas fa-phone"></i><span style="color:blue;"> Phone :</span>
                {{ $user->phone }}</h5>
            <h5><i style="color: red" class="fas fa-globe"></i><span style="color:blue;"> Website :</span>
                {{ $user->website }}</h5>
            <h5><i style="color: red" class="fab fa-linkedin"></i><span style="color:blue;"> Linkedin :</span>
                {{ $user->linkedin }}
            </h5>
            <h5><i style="color: red" class="fab fa-github"></i><span style="color:blue;"> Git-Hub :</span>
                {{ $user->github }}</h5>
            <h5><i style="color: red" class="fab fa-facebook"></i><span style="color:blue;"> Facebook :</span>
                {{ $user->facebook }}
            </h5>
            <h5><i style="color: red" class="fab fa-twitter"></i><span style="color:blue;"> Twitter :</span>
                {{ $user->twitter }}</h5>
            <h5><i style="color: red" class="fab fa-youtube"></i><span style="color:blue;"> Youtube :</span>
                {{ $user->youtube }}</h5>
            <h5><i style="color: red" class="fas fa-id-card"></i><span style="color:blue;"> NID :</span>
                {{ $user->nid }}</h5>
            <h5><i style="color: red" class="fas fa-passport"></i><span style="color:blue;"> Passport :</span>
                {{ $user->passport }}
            </h5>
            <h5><i style="color: red;" class="fas fa-info-circle"></i><span style="color: blue;"> About :</span>
                {{ $user->about }}
            </h5>
        </div>
        <h3>{{ $user->name }}'s recent blogs</h3>
        @if (Auth::check() && Auth::user()->id === $user->id)
            <p>Role: {{ $user->role->name }}</p>
            <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->username) }}">Edit</a>
            <hr>
            @foreach ($user->blogs as $blog)
                <h4><a style="text-decoration:none;"
                        href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                </h4>
            @endforeach
        @else
            <hr>
            @foreach ($user->blogs as $blog)
                <h4><a style="text-decoration:none;"
                        href="{{ route('blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                </h4>
            @endforeach
        @endif
    </div>
@endsection
