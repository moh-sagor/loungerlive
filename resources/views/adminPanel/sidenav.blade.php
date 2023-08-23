<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Dashboard</div>

            {{-- for admin  --}}
            @if (Auth::user() && Auth::user()->role_id === 1)
                <a class="nav-link" href="{{ route('blogs.create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-pencil-alt"></i></div>
                    Create Blog
                </a>
                <a class="nav-link" href="{{ route('categories.create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-plus"></i></div>
                    Create Category
                </a>
                <a class="nav-link" href="{{ route('blogs.trash') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-trash"></i></div>
                    Trashed Blog
                </a>
                <a class="nav-link" href="{{ route('admin.blogs') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-check-circle"></i></div>
                    Published / Drafted
                </a>
                <a class="nav-link" href="{{ route('admin.users') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Manage Users
                </a>
                <a class="nav-link" href="{{ route('users.edit', ['username' => Auth::user()->username]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-edit"></i></div>
                    Update Profile
                </a>
                <a class="nav-link" href="{{ route('emails.show') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Author Request
                </a>
            @endif

            {{-- for author   --}}
            @if (Auth::user() && Auth::user()->role_id === 2)
                <a class="nav-link" href="{{ route('blogs.create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-pencil-alt"></i></div>
                    Create Blog
                </a>
                <a class="nav-link" href="{{ route('categories.create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-plus"></i></div>
                    Create Category
                </a>
                <a class="nav-link" href="{{ route('users.edit', ['username' => Auth::user()->username]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-edit"></i></div>
                    Update Profile <span class="badge badge-pill badge-primary">Primary</span>
                </a>
            @endif

            {{-- for subscriber  --}}
            @if (Auth::user() && Auth::user()->role_id === 3)
                <a class="nav-link" href="{{ route('users.edit', ['username' => Auth::user()->username]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-edit"></i></div>
                    Update Profile
                </a>
            @endif

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as: {{ ucfirst(Auth::user()->role->name) }}</div>
    </div>
</nav>
