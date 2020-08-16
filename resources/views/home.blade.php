@extends('layouts.app')

@section('content')
<section id="home">
    {{--Carousel--}}
    <section id="Carousel">
        <div class="container-fluid">
            <div class="row">
                <div class="col px-0">
                    <div id="carousel" class="carousel slide" data-ride="carousel" data-pause="false"
                         data-interval="8000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/commercial/Carousel1-1.png') }}" class="d-block w-100"
                                     alt="{{ __('Free shipping ad') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/commercial/Carousel1-2.png') }}" class="d-block w-100"
                                     alt="{{ __('products out of this world ad') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/commercial/Carousel1-3.png') }}" class="d-block w-100"
                                     alt="{{ __('graphics cards ad') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/commercial/Carousel1-4.png') }}" class="d-block w-100"
                                     alt="{{ __('pc gamers ad') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/commercial/Carousel1-5.png') }}" class="d-block w-100"
                                     alt="{{ __('fevermania ad') }}">
                            </div>
                            <a class="carousel-control-prev" href="#carousel" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--/Carousel--}}

    {{--Services--}}
    <section class="s-services">
        <div class="container text-white text-center py-5">
          <div class="s-facts-header">
            <h3 class="mb-0">{{ __('Services') }}</h3>
            <h2 class="mb-5">{{ __('What We Offer') }}</h2>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fas fa-truck-loading"></i>
              </span>
              <h4>
                <strong>{{ __('National deliveries') }}</strong>
              </h4>
              <p class="text-faded mb-0">{{ __('You tell us where and we take it') }}</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="far fa-money-bill-alt"></i>
              </span>
              <h4>
                <strong>{{ __('The lowest prices') }}</strong>
              </h4>
              <p class="text-faded mb-0">{{ __('If you find it cheaper in another store, we lower the price!') }}</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fas fa-bolt"></i>
              </span>
              <h4>
                <strong>{{ __('High speed service') }}</strong>
              </h4>
              <p class="text-faded mb-0">{{ __('Receive your products in less than 24 hours!') }}</p>
            </div>
            <div class="col-lg-3 col-md-6">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fab fa-whatsapp"></i>
              </span>
              <h4>
                <strong>{{ __('Customer Support') }}</strong>
              </h4>
              <p class="text-faded mb-0">{{ __('Call us or write us on whatsapp').' 3218876733' }}</p>
            </div>
          </div>
        </div>
      </section>
    {{--/Services--}}

</section>
@endsection
