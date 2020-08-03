<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="png" href="{{ asset('images/main/TfIcon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/81e6b2932c.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        {{-- Header --}}
        <nav class="navbar navbar-expand-lg navbar-dark">
          <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/main/TfIcon.png') }}" alt="Logo de TecFever"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form action="{{ route('products.shop') }}" class="form-inline my-2 my-lg-0" method="GET">
              <input name="name" class="form-control mr-sm-2" size="40" type="search" placeholder="{{ __('¡Find what you are looking for with a click!') }}" aria-label="Search">
              <button class="btn btn-outline-light my-2 my-sm-0" type="submit">{{ __('Search') }}</button>
            </form>
            <a class="btn btn-outline-success ml-2" href="{{ route('products.shop') }}">{{ __('Go to shop') }}</a>
            {{--Authentication--}}
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item text-center text-sm-left">
                        <a class="btn btn-dark align-items-center d-flex" href="{{ route('login') }}"><i class="far fa-user-circle pr-2 fa-lg"></i><b>{{ __('Login') }}</b></a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->isAdmin)
                                <a class="dropdown-item" href="{{ route('controlPanel') }}">
                                    {{ __('Control Panel') }}
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            {{--/Authentication--}}
          </div>
        </nav>
        {{-- /Header --}}
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>