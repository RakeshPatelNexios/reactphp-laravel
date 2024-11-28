<div class="container-xxl container-xl container-lg container-md container-sm">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top bg-dark px-3">
        <p class="col-md-4 text-start mb-0 text-white">Copyright &copy; {{ date('Y') }}</p>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item">
                <a href="{{ route('items.list') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="header-logo"/>
                </a>
            </li>
        </ul>
    </footer>
</div>