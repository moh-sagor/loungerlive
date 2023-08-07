<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @if (Route::has('login'))
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if (Route::has('login'))
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item ms-2">
                                <a class="nav-link" href="{{ route('blogs.index') }}">
                                    Blogs <span class="badge badge-light bg-secondary">{{ $blogs->count() }}</span>
                                </a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <h5 class="nav-link border border-primary rounded p-2 bg-light text-dark">Hi
                                        {{ Auth::user()->name }} as {{ Auth::user()->role->name }}</h5>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('users.profile_show', ['username' => Auth::user()->username]) }}">Profile</a>
                                </li>

                                @if (Auth::user() && Auth::user()->role_id === 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a>
                                    </li>
                                @elseif(Auth::user() && Auth::user()->role_id === 2)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a>
                                    </li>
                                @elseif(Auth::user() && Auth::user()->role_id === 3)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-link">{{ __('Log Out') }}</button>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    @endif
                </div>

            @endif
        </div>
    </div>
</nav>
