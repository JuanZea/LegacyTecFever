@extends('layouts.app')

@section('content')

    {{--Void--}}
    <section class="container-fluid void-height scene-chip position-relative">
        <div class="overlay hole d-flex justify-content-center align-items-center">
        </div>
    </section>
    {{--/Void--}}

    {{--Carousel--}}
    <section class="container-fluid">
        <div class="row">
            <div class="col px-0">
                <div id="carousel" class="carousel slide" data-ride="carousel" data-pause="false" data-interval="8000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            @if (config('app.locale') == 'en')
                                <img src="{{ asset('images/commercial/carousel_1.png') }}" class="d-block w-100"
                                 alt="@lang('free_shipping_ad')">
                            @else
                                <img src="{{ asset('images/commercial/carrusel_1.png') }}" class="d-block w-100"
                                 alt="@lang('free_shipping_ad')">
                            @endif
                        </div>
                        <div class="carousel-item">
                            @if (config('app.locale') == 'en')
                                <img src="{{ asset('images/commercial/carousel2.png') }}" class="d-block w-100"
                                 alt="@lang('products_out_of_this_world_ad')">
                            @else
                                <img src="{{ asset('images/commercial/carrusel_2.png') }}" class="d-block w-100"
                                 alt="@lang('products_out_of_this_world_ad')">
                            @endif
                        </div>
                        <div class="carousel-item">
                            @if (config('app.locale') == 'en')
                                <img src="{{ asset('images/commercial/carousel3.png') }}" class="d-block w-100"
                                 alt="@lang('graphics_cards_ad')">
                            @else
                                <img src="{{ asset('images/commercial/carrusel_3.png') }}" class="d-block w-100"
                                 alt="@lang('graphics_cards_ad')">
                            @endif
                        </div>
                        <div class="carousel-item">
                            @if (config('app.locale') == 'en')
                                <img src="{{ asset('images/commercial/carousel4.png') }}" class="d-block w-100"
                                 alt="@lang('pc_gamers_ad')">
                            @else
                                <img src="{{ asset('images/commercial/carrusel_4.png') }}" class="d-block w-100"
                                 alt="@lang('pc_gamers_ad')">
                            @endif
                        </div>
                        <div class="carousel-item">
                            @if (config('app.locale') == 'en')
                                <img src="{{ asset('images/commercial/carousel5.png') }}" class="d-block w-100"
                                 alt="@lang('fevermania_ad')">
                            @else
                                <img src="{{ asset('images/commercial/carrusel_5.png') }}" class="d-block w-100"
                                 alt="@lang('fevermania_ad')">
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#carousel" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#carousel" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--/Carousel--}}

    {{--Void--}}
    <section class="container-fluid void-height scene-chip position-relative">
        <div class="overlay hole d-flex justify-content-center align-items-center">
        </div>
    </section>
    {{--/Void--}}

    {{--Facade-1--}}
    <section class="container-fluid">
        <div class="row position-relative">
            <div class="overlay">
                <div class="container pt-5 mt-5 fill ani-grow align-middle">
                    <div class="row pt-5 text-right">
                        <div class="col">
                            <img src="{{ asset('images/main/TfLogo.png') }}" alt="@lang('dic.tf_lg')">
                        </div>
                    </div>
                </div>
            </div>
            <img class="img-fluid" src="{{ config('app.locale') == 'en' ? asset('images/commercial/facade_1.png') : asset('images/commercial/fachada_1.png') }}" alt="@lang('advertising of national shipments')">
        </div>
    </section>
    {{--/Facade-1--}}

    {{--Services--}}
    <section class="container-fluid text-white text-center py-5 scene-squad position-relative">
        <div class="overlay hole"></div>
        <div class="row justify-content-center">
            <h2 class="mb-0 title-tec">{{ strtoupper(trans('services')) }}</h2>
        </div>
        <div class="row justify-content-center">
            <h2 class="mb-5">@lang('what we offer')</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <span class="service-icon rounded-circle mx-auto mb-3 hvr-grow-rotate">
                    <i class="fas fa-truck-loading"></i>
                </span>
                <h4>
                    <strong>{{ ucfirst(trans('national deliveries')) }}</strong>
                </h4>
                <p class="text-faded mb-0">{{ ucfirst(trans('dic.tell_us_where')) }}</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <span class="service-icon rounded-circle mx-auto mb-3 hvr-grow-rotate">
                    <i class="far fa-money-bill-alt"></i>
                </span>
                <h4>
                    <strong>{{ ucfirst(trans('the lowest prices')) }}</strong>
                </h4>
                <p class="text-faded mb-0">{{ ucfirst(trans('dic.we_lower_the_price')) }}</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                <span class="service-icon rounded-circle mx-auto mb-3 hvr-grow-rotate">
                    <i class="fas fa-bolt"></i>
                </span>
                <h4>
                    <strong>{{ ucfirst(trans('high speed service')) }}</strong>
                </h4>
                <p class="text-faded mb-0">{{ ucfirst(trans('dic.less_than_24_hours')) }}</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <span class="service-icon rounded-circle mx-auto mb-3 hvr-grow-rotate">
                    <i class="fab fa-whatsapp"></i>
                </span>
                <h4>
                    <strong>{{ ucfirst(trans('customer support')) }}</strong>
                </h4>
                <p class="text-faded mb-0">{{ ucfirst(trans('dic.call_us_wp')) }}</p>
            </div>
      </div>
    </section>
    {{--/Services--}}

@endsection
