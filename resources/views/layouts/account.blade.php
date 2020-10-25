@extends('layouts.app')

@section('content')
<section id="account">
    {{--Main--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 py-3 bg-tec px-0 flex-column d-flex justify-content-around">

                <a style="text-decoration: none" href="{{ route('account', ['section' => 0]) }}" class="d-flex align-items-center tab-sidebar @if ($section == 0)
                    tab-sidebar-active
                @endif">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 d-flex justify-content-center align-items-center">
                                <i class="far fa-address-card text-white"></i>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center">
                                <p class="text-white mb-0 text-center">{{ __('Personal information') }}</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a style="text-decoration: none" href="{{ route('account', ['section' => 1]) }}" class="d-flex align-items-center tab-sidebar @if ($section == 1)
                    tab-sidebar-active
                @endif">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 d-flex justify-content-center align-items-center">
                                <i class="fas fa-money-bill-wave text-white"></i>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center">
                                <p class="text-white mb-0 text-center">{{ __('Shopping history') }}</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a style="text-decoration: none" href="{{ route('account', ['section' => 2]) }}" class="d-flex align-items-center tab-sidebar @if ($section == 2)
                    tab-sidebar-active
                @endif">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 d-flex justify-content-center align-items-center">
                                <i class="fas fa-user-cog text-white"></i>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center">
                                <p class="text-white mb-0 text-center">{{ __('Configuration') }}</p>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col py-3 pr-0" style="background-color: #070E1C">
                @yield('content-account')
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection
