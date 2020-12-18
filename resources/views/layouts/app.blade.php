<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="png" href="{{ asset('images/main/TfIcon.png') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TecFever') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/functions.js') }}" defer></script>

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
            <section class="container-fluid px-0 scene-nav position-relative">
                <div class="overlay hole"></div>
                <nav class="navbar navbar-expand-lg navbar-dark py-0">
                    <a class="navbar-brand hvr-pulse-grow" href="{{ route('home') }}"><img class="stamp" src="{{ asset('images/main/TfIcon.png') }}" alt="@lang('dic.tf_ic')"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form action="{{ route('shop') }}" class="form-inline my-2 my-lg-0" method="GET">
                            <input name="name" class="form-control mr-sm-2" size="40" type="search" placeholder="{{ config('app.locale') == 'es' ? '¡' : '' }}{{ ucfirst(trans('find what you are looking')) . '!' }}"
                            value="{{ isset($name) ? $name : ''}}" aria-label="Search">
                            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">{{ ucfirst(trans('search')) }}</button>
                        </form>
                        <a class="btn btn-outline-success ml-2" href="{{ route('shop') }}">{{ ucfirst(trans('go to shop')) }}</a>
                        <shopping-cart-link-component :amount="{{ Auth::user()->shoppingCart->amount }}" :user="{{ Auth::id() }}" :quantity="quantity" :route="'{{ route('shoppingCarts.show', Auth::user()->shoppingCart) }}'"></shopping-cart-link-component>

                        {{--Authentication--}}
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name.' '.Auth::user()->surname }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->hasRole('admin'))
                                        <a class="dropdown-item" href="{{ route('control_panel') }}">
                                            {{ ucfirst(trans('control panel')) }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('account') }}">
                                        {{ ucfirst(trans('account')) }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('shoppingCarts.show', Auth::user()->shoppingCart) }}">
                                      {{ ucfirst(trans('shopping cart')) }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                            document.getElementById('logout-form').submit();">
                                        {{ ucfirst(trans('logout')) }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        {{--/Authentication--}}

                    </div>
                </nav>
            </section>
            {{-- /Header --}}

            {{-- Main --}}
            <main class="main">
                @yield('content')
            </main>
            {{-- /Main --}}

            {{-- Footer --}}
            <section class="container-fluid py-3 scene-nav-alt position-relative">
                <div class="overlay hole-top"></div>
                <div class="row text-center font-transformers">
                    <div class="col">
                        <a class="nav-link" href="#">{{ ucfirst(trans('terms and conditions')) }}</a>
                    </div>
                    <div class="col">
                        <a class="nav-link" href="#">{{ ucfirst(trans('privacy policies')) }}</a>
                    </div>
                    <div class="col">
                        <a class="nav-link" href="#">{{ ucfirst(trans('about us')) }}</a>
                    </div>
                    <div class="col">
                        <a class="nav-link" href="#">{{ ucfirst(trans('contact us')) }}</a>
                    </div>
                    <div class="col">
                        <a class="nav-link" href="#">{{ ucfirst(trans('social networks')) }}</a>
                    </div>
                </div>
            </section>
            {{-- /Footer --}}

        </div>
    </body>
</html>
