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
        <nav class="navbar navbar-expand-lg navbar-dark">
          <a class="navbar-brand hvr-pulse-grow" href="{{ route('home') }}"><img src="{{ asset('images/main/TfIcon.png') }}" alt="Logo de TecFever"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form action="{{ route('shop') }}" class="form-inline my-2 my-lg-0" method="GET">
              <input name="name" class="form-control mr-sm-2" size="40" type="search" placeholder="{{ __('¡Find what you are looking for with a click!') }}"
                     @if (isset($name))
                         value="{{ $name }}"
                     @endif
                     aria-label="Search">
              <button class="btn btn-outline-light my-2 my-sm-0" type="submit">{{ __('Search') }}</button>
            </form>
            <a class="btn btn-outline-success ml-2" href="{{ route('shop') }}">{{ __('Go to shop') }}</a>
            <shopping-cart-link-component :amount="{{ Auth::user()->shoppingCart->amount }}" :user="{{ Auth::id() }}" :quantity="quantity" :route="'{{ route('shoppingCarts.show', Auth::user()->shoppingCart) }}'"></shopping-cart-link-component>

{{--            <a v-cloak class="ml-auto mr-3 text-warning nd" href="{{ route('shopping-cart.router') }}"><i class="fas fa-shopping-cart fa-lg hvr-buzz-out"></i>--}}
{{--            @if (Auth::user()->shoppingCart)--}}
{{--                <b>--}}
{{--                    {{ Auth::user()->shoppingCart->amount }}--}}
{{--                </b>--}}
{{--            @endif--}}
{{--            <b v-if="quantity>0">@{{ " + ( " + quantity + " )" }}</b>--}}
{{--            </a>--}}

            {{--Authentication--}}
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name.' '.Auth::user()->surname }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->isAdmin)
                            <a class="dropdown-item" href="{{ route('controlPanel') }}">
                                {{ __('Control Panel') }}
                            </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('account', 0) }}">
                            {{ __('Account') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('shoppingCarts.show', Auth::user()->shoppingCart) }}">
                          {{ __('Shopping cart') }}
                        </a>
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
            </ul>
            {{--/Authentication--}}

          </div>
        </nav>
        {{-- /Header --}}

        {{-- Main --}}
        <main class="s-main">
            @yield('content')
        </main>
        {{-- /Main --}}

        {{-- Footer --}}
        <div class="s-footer container-fluid py-3">
            <div class="row text-center">
                <div class="col">
                    <a class="nav-link" href="#">{{ __("Terms and conditions") }}</a>
                </div>
                <div class="col">
                    <a class="nav-link" href="#">{{ __("Privacy policies") }}</a>
                </div>
                <div class="col">
                    <a class="nav-link" href="#">{{ __("About us") }}</a>
                </div>
                <div class="col">
                    <a class="nav-link" href="#">{{ __("Contact us") }}</a>
                </div>
                <div class="col">
                    <a class="nav-link" href="#">{{ __("Social networks") }}</a>
                </div>
            </div>
        </div>
        {{-- /Footer --}}
    </div>
</body>
</html>
{{--<script>--}}
{{--    import ShoppingCartLink from "../../js/components/ShoppingCartLink";--}}
{{--    export default {--}}
{{--        components: {ShoppingCartLink}--}}
{{--    }--}}
{{--</script>--}}
