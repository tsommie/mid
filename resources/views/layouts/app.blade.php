<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Anitche Chisom">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'X-UUID') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('stylesheets')
</head>
<body class="bg-light">
    <div id="app">
        <nav id="primary-navigation-bar" class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'X-UUID') }}
                </a>
              <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="navbar-collapse offcanvas-collapse bg-dark" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <language-selector-component></language-selector-component>

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
              </div>
            </div>
        </nav>

        @yield('highlight')

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="footer text-muted py-5 mt-auto bg-white">
            <div class="container">
              <p class="float-right mb-1">
                <a href="#">{{ __('Back to top') }}</a>
              </p>
                <p class="mb-1">{{ config('app.name', 'X-UUID') }} is a joint collaboration project between <span class="font-weight-bold">{{ __('Nascent Africa') }}</span> and <span class="font-weight-bold">{{ __('ScoringCard') }}</span>!</p>
              <p class="mb-0">{{ config('app.name', 'X-UUID') }} ©{{ date('Y') }}.</p>
            </div>
          </footer>
    </div>

    <script>
        window.locale = @json(str_replace('_', '-', app()->getLocale()))
    </script>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        (function () {
            'use strict'

            document.querySelector('[data-toggle="offcanvas"]').addEventListener('click', function () {
                document.querySelector('.offcanvas-collapse').classList.toggle('open')
            })
        })()
    </script>
</body>
</html>
