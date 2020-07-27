<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="png" href="{{ asset('images/main/TfIcon.png') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TecFever</title>

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
        <section id="login">
            {{-- Header --}}
            <div class="header container-fluid">
                <div class="row">
                    <div class="col my-2">
                        <a href="/"><img style="height: 50px;" src="{{ asset('images/main/BackIcon.png') }}" alt="Back"></a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <img src="{{ asset('images/main/LoginTitle.png') }}" alt="Logo de TecFever">
                </div>
            </div>
            {{-- /Header --}}

            {{-- Form --}}
            <div class="form container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">
                                                    Recuérdame
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn btn-dark btn-lg btn-block form-control">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <div class="form-group row mb-0 mt-3 d-flex justify-content-center">
                                        <a class="link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Form --}}
        </section>
    </body>
</html>