<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ route('blogs.index') }}">{{ strtoupper(Auth::user()->role->name) }}</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            {{-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> --}}
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                @if (Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Photo" height="35"
                        width="35" class="rounded-circle avatar">
                @else
                    <img src="{{ asset('images/default_profile.jpg') }}" alt="Profile Photo" height="35"
                        width="35" class="rounded-circle">
                @endif

            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @if (Route::has('login'))
                    @auth
                        <li><a class="dropdown-item"
                                href="{{ route('users.profile_show', ['username' => Auth::user()->username]) }}">Profile</a>
                        </li>
                        @if (Auth::user() && Auth::user()->role_id === 1)
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.index') }}">Dashboard</a>
                            </li>
                        @elseif(Auth::user() && Auth::user()->role_id === 2)
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.index') }}">Dashboard</a>
                            </li>
                        @elseif(Auth::user() && Auth::user()->role_id === 3)
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.index') }}">Dashboard</a>
                            </li>
                        @endif
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    @endauth
                @endif
            </ul>
        </li>
    </ul>
</nav>

<!-- Include Bootstrap CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Initialize Bootstrap dropdown -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    });
</script>
