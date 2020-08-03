<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="png" href="{{ 'images/main/TfIcon.png' }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('APP_NAME') }}</title>

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
        <section id="welcome">
            {{-- Header --}}
            <div class="s-header container-fluid">
                <div class="row">
                    <div class="col text-right my-2">
                        <a class="px-2 rounded" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <img src="{{ asset('images/main/TfLogo.png') }}" alt="Logo de TecFever">
                </div>
            </div>
            {{-- /Header --}}

            {{-- Facts --}}
            <div class="s-facts text-center">
                <div>
                    <h1 class="mb-5 display-4 text-uppercase">{{ __('We have a fever for technology') }}</h1>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-around align-items-center">
                    <div class="flex-column">
                        <i class="fas fa-mobile-alt fa-10x py-3" style="color: #AC0002;"></i>
                        <div class="text-center text-uppercase">{{ __('Smartphones') }}</div>
                    </div>
                    <div class="flex-column">
                        <i class="fas fa-laptop fa-10x py-3" style="color: #AC0002;"></i>
                        <div class="text-center text-uppercase">{{ __('Computers') }}</div>
                    </div>
                    <div class="flex-column">
                        <i class="fas fa-mouse fa-10x py-3" style="color: #AC0002;"></i>
                        <div class="text-center text-uppercase">{{ __('Accessories') }}</div>
                    </div>
                </div>
            </div>
            {{-- /Facts --}}

            {{-- Poster --}}
            <div class="s-poster">
                <img src="{{ asset('images/commercial/Poster1-1.png') }}" alt="Invitación para registrarse">
            </div>
            {{-- /Poster --}}

            {{-- Steps --}}
            <div class="s-steps container d-flex">
                <img src="{{ asset('images/main/Sentence1.png') }}" alt="¡Únete Ahora!">
                <a class="btn btn-lg btn-success btn-block align-self-center" href="{{ route('register') }}"><b>{{ __('Sign up') }}</b></a>
            </div>
            {{-- /Steps --}}
        </section>
    </body>
</html>