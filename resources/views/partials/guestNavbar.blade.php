<nav class="home navbar-expand-md navbar-light px-5">
    <div class="container navbar">
        <a href="{{ url('/') }}">
            <img class="logo" height="50" src="{{ asset('img/logo_white.svg') }}" alt="Logo">
        </a>
        <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            {{-- <form class="d-flex m-auto align-items-center">
                <div class="search_bar d-flex m-auto align-items-center">
                    <input class="form-control me-2 search" type="search" placeholder="Search an apartment"
                        aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass fa-lg search_icon"></i>
                </div>


            </form> --}}

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav justify-content-end align-items-center">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="login" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="register" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="text-white email dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->email }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('registered.dashboard') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
