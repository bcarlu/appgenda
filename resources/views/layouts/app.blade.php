<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ secure_url('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_url('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="@can('in-dashboard') background: #74b9ff; @else background: #6c5ce7; @endcan">
            <div class="container">
                <a class="navbar-brand text-light font-weight-bold" href=" @guest {{ secure_url('/') }} @endguest @auth @if(Auth::user()->id_role == 1) {{ secure_url('/dashboard') }} @else {{ secure_url('/home') }} @endif @endauth 
                 "> 
                    {{ config('app.name', 'Appgendate') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon text-light"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-outline-light font-weight-bold mr-1 my-2 my-sm-0" href="{{ route('login') }}">{{ __('Ingreso') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-light font-weight-bold my-2 my-sm-0" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="#" class="btn btn-light font-weight-bold my-2 my-sm-0 mr-1 float-right">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                               <a class="btn btn-danger font-weight-bold my-2 my-sm-0 float-right" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> 
                                    {{ __('Salir') }}
                                </a> 
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 min-vh-100 " style="background: #dfe6e9;">
            @yield('content')
        </main>
    </div>
</body>
</html>
