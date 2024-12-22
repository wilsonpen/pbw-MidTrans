<nav class="navbar bg-primary navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                     @auth
                     
					                <a class="nav-link " aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
					            @else
					                <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a>
					            @endauth
                </li>
            </ul>
            @auth
                <ul class="d-flex navbar-nav ">
                    <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                    @canany(['role-list','role-create','role-edit','role-delete'])
                            <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                    @endcan
                            @canany(['product-list','product-create','product-edit','product-delete'])
                            <li><a class="nav-link" href="{{ route('products.index') }}">Manage Product</a></li>
                            @endcan
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }} <br>
                            <span class="fw-lighter fs-6">{{ Auth::user()->email }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            {{-- <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li> --}}
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>
