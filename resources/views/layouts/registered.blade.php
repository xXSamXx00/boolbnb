<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.39.0/maps/maps-web.min.js"></script>
    <script src="{{ asset('js/registered.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.39.0/maps/maps.css'>
    <link href="{{ asset('css/registered.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="navbar navbar-dark sticky-top bg-azure flex-md-nowrap px-4 shadow">
            <a href="{{ url('/') }}">
                <img height="50" src="{{ asset('img/logo_white.svg') }}" alt="Logo">
            </a>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->email }}
                    </a>

                    <div class="dropdown-menu position-absolute dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            </ul>
            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="link {{ Route::currentRouteName() === 'registered.dashboard' ? 'link-active' : '' }} "
                                    aria-current="page" href="{{ route('registered.dashboard') }}">
                                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="link {{ Route::currentRouteName() === 'registered.apartments.index' ? 'link-active' : '' }}"
                                    href="{{ route('registered.apartments.index') }}">
                                    <i class="fa-solid fa-house"></i> Apartments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="link {{ Route::currentRouteName() === 'registered.contacts.index' ? 'link-active' : '' }}"
                                    href="{{ route('registered.contacts.index') }}">
                                    <i class="fa-solid fa-message"></i> Messages
                                </a>
                            </li>

                        </ul>

                    </div>
                </nav>

                <main class="col-md-10 col-lg-10 px-md-2 mx-auto flex-grow-1">

                    @yield('content')

                </main>
            </div>
        </div>

    </div>
</body>

</html>
