@extends('adminPanel.mainpage')
@section('main')
    <div class="container"style="padding-top: 10px;">
        <style>
            .sky-input {
                background-color: rgba(147, 211, 216, 0.574);
            }
        </style>
        <div class="row">
            <div class="col-md-3 col-12 border rounded border-success ms-3">
                @if (Auth::check() && Auth::user()->id === $user->id)
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
                    <h5 class="mt-2"><i style="color: red" class="fas fa-user"></i><span style="color:blue;"> Profession
                            :</span>
                        {{ $user->profession }}</h5>
                    <h5 class="mt-2"><i style="color: red" class="fas fa-map-marker-alt"></i><span style="color:blue;">
                            Address
                            :</span>
                        {{ $user->address }}</h5>

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
                @else
                    <p>You are not allowed to edit this user's details.</p>
                @endif
            </div>
            <div class="col-md-8 col-12 border rounded border-success ms-1">
                @if (Auth::check() && Auth::user()->id === $user->id)
                    <h3 class="d-flex justify-content-center">Please fill the gaps with correct information </h3>
                    <hr>
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control sky-input" id="name" name="name"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control sky-input" id="username" name="username"
                                        value="{{ $user->username }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control sky-input" id="address" name="address"
                                        value="{{ $user->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control sky-input" id="email" name="email"
                                        value="{{ $user->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="about" class="form-label">About</label>
                                    <textarea class="form-control sky-input" id="about" name="about" rows="3">{{ $user->about }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">phone</label>
                                    <input type="text" class="form-control sky-input" id="phone" name="phone"
                                        value="{{ $user->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="website" class="form-label">website</label>
                                    <input type="text" class="form-control sky-input" id="website" name="website"
                                        value="{{ $user->website }}">
                                </div>
                                <div class="form-group">
                                    <label for="linkedin" class="form-label">linkedin</label>
                                    <input type="text" class="form-control sky-input" id="linkedin" name="linkedin"
                                        value="{{ $user->linkedin }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profession" class="form-label">Profession</label>
                                    <input type="text" class="form-control sky-input" id="profession"
                                        name="profession" value="{{ $user->profession }}">
                                </div>
                                <div class="form-group">
                                    <label for="github" class="form-label">github</label>
                                    <input type="text" class="form-control sky-input" id="github" name="github"
                                        value="{{ $user->github }}">
                                </div>
                                <div class="form-group">
                                    <label for="facebook" class="form-label">facebook</label>
                                    <input type="text" class="form-control sky-input" id="facebook" name="facebook"
                                        value="{{ $user->facebook }}">
                                </div>
                                <div class="form-group">
                                    <label for="twitter" class="form-label">twitter</label>
                                    <input type="text" class="form-control sky-input" id="twitter" name="twitter"
                                        value="{{ $user->twitter }}">
                                </div>
                                <div class="form-group">
                                    <label for="youtube" class="form-label">youtube</label>
                                    <input type="text" class="form-control sky-input" id="youtube" name="youtube"
                                        value="{{ $user->youtube }}">
                                </div>
                                <div class="form-group">
                                    <label for="nid" class="form-label">nid</label>
                                    <input type="text" class="form-control sky-input" id="nid" name="nid"
                                        value="{{ $user->nid }}">
                                </div>
                                <div class="form-group">
                                    <label for="passport" class="form-label">passport</label>
                                    <input type="text" class="form-control sky-input" id="passport" name="passport"
                                        value="{{ $user->passport }}">
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="file" class="form-control sky-input" id="photo" name="photo">
                                </div>
                            </div>

                            <div class="d-flex justify-content-center m-3">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>

                    </form>
                @else
                    <p>You are not allowed to edit this user's details.</p>
                @endif
            </div>
        </div>

    </div>
@endsection
