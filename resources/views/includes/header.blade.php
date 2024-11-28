<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom bg-dark px-3">
    <a href="{{ route('items.list') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="header-logo"/>
    </a>

    <ul class="nav nav-pills my-auto">        
        {{-- @guest
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a>
            </li>
        @endguest --}}

        @guest
            <li class="nav-item">
                <a href="{{ route('items.list') }}" class="nav-link {{ Request::is('itemslist') ? 'text-primary' : 'text-white' }}">Items</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('items.create') }}" class="nav-link {{ Request::is('itemscreate') ? 'text-primary' : 'text-white' }}">Create Item</a>
            </li>
        @endguest
    </ul>
</header>