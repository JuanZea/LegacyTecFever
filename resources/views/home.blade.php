@extends('layouts.app')

@section('content')
    <section id="Home">
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
    </section>
@endsection