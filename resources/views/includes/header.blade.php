<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="{{ route('home') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="header-logo"/>
    </a>

    <ul class="nav nav-pills my-auto">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
        </li>
        @guest
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a>
            </li>
        @endguest

        @auth
            <li class="nav-item">
                <a href="{{ route('signout') }}" class="nav-link">Logout</a>
            </li>
        @endauth
    </ul>
</header>