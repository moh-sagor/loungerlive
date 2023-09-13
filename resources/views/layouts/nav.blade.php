<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/loungerlive.png') }}" alt="Logo" height="45">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @if (Route::has('login'))
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="container-fluid">
                        <div class="row justify-content-between">

                            <!-- Left Content -->
                            <div class="col-auto">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item ms-2 nav-hover">
                                        <a class="nav-link" href="{{ route('blogs.bindex') }}">
                                            Blogs
                                        </a>
                                    </li>
                                    <li class="nav-item nav-hover">
                                        <a class="nav-link" href="{{ route('courses.index') }}">
                                            Courses
                                        </a>
                                    </li>
                                    <li class="nav-item nav-hover">
                                        <a class="nav-link" href="{{ route('movies.index') }}">
                                            Movies
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Right Content -->
                            <div class="col-auto">
                                <div class="dropdown">
                                    @auth
                                        <a class="btn dropdown-toggle" href="#" role="button" id="profileDropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <!-- Profile Photo -->
                                            @if (Auth::user()->photo)
                                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Photo"
                                                    height="35" width="35" class="rounded-circle avatar">
                                            @else
                                                <img src="{{ asset('images/default_profile.jpg') }}" alt="Profile Photo"
                                                    height="35" width="35" class="rounded-circle">
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                            @if (Route::has('login'))
                                                @auth
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('users.profile_show', ['username' => Auth::user()->username]) }}">Profile</a>
                                                    </li>
                                                    @if (Auth::user() && Auth::user()->role_id === 1)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.index') }}">Dashboard</a>
                                                        </li>
                                                    @elseif(Auth::user() && Auth::user()->role_id === 2)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.index') }}">Dashboard</a>
                                                        </li>
                                                    @elseif(Auth::user() && Auth::user()->role_id === 3)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.index') }}">Dashboard</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            <button type="submit"
                                                                class="dropdown-item">{{ __('Log Out') }}</button>
                                                        </form>
                                                    </li>
                                                @endauth
                                            @endif
                                        </ul>
                                    @else
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item">
                                                <a class="custom-btn btn-11 nav-link btn btn-sm btn-primary ubuntu-font"
                                                    href="{{ route('login') }}">Log in</a>
                                            </li>
                                        </ul>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
        </div>
    </div>
</nav>
