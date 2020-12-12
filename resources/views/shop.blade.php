@extends('layouts.app')

@section('content')

    <section class="container-fluid {{ rand(0,1) != 0 ? 'scene-chip' : 'scene-chip-alt' }}">

        {{-- Header --}}
        <section class="container">
            <div class="row text-center">
                <div class="col">
                   @if (config('app.locale') == 'en')
                        <img class="img-fluid stamp-lg" src="{{ asset('images/main/shop.png') }}" alt="@lang('shop title')">
                   @else
                        <img class="img-fluid stamp-lg" src="{{ asset('images/main/tienda.png') }}" alt="@lang('shop title')">
                   @endif
                </div>
            </div>
        </section>
        {{-- /Header --}}

        {{-- Showcase --}}
        <section class="container pb-5">
            <div class="row py-3">
                <div class="container">
                    <div class="row">
                        @foreach($products as $product)
                            @if($product->is_enabled)
                                <div class="col-md-4 py-3">
                                    <a id="carcass" class="card p-0 mask shadow hvr-grow-shadow text-decoration-none" href="{{ route('products.show',$product) }}">
                                        <div class="card-header text-center p-0">
                                            <img class="img-fluid" src="{{ $product->get_image }}" alt="@lang('product image')">
                                        </div>
                                        @switch($product->category)
                                            @case('computer')
                                                <?php $color = 'bg-computer'?>
                                                @break
                                            @case('smartphone')
                                                <?php $color = 'bg-smartphone'?>
                                                @break
                                            @case('accessory')
                                                <?php $color = 'bg-accessory'?>
                                                @break
                                            @default
                                                <?php $color = 'bg-danger'?>
                                        @endswitch
                                        <div class="text-center {{ $color }} hole">
                                            <span class="text-white"><b>{{ strtoupper(__($product->category)) }}</b></span>
                                        </div>
                                        <div class="card-body d-flex flex-md-column justify-content-between">
                                            <div class="div">
                                                <p class="text-dark text-center">{{ $product->name }}</p>
                                            </div>
                                            <div class="align-self-center price">
                                                <span><b>{{ \App\Helpers\Formatters::priceFormatter($product->price) }}</b></span><br>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                        {{-- Alert --}}
                        @if ($empty)
                            <section class="container">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="alert alert-primary shadow" role="alert">
                                          @lang('dic.var.empty_table', ['model' => trans('products')])
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col text-center">
                                        <a class="hvr-icon-spin text-dark br-white"><i class="fas fa-10x fa-box-open hvr-icon"></i></a>
                                    </div>
                                </div>
                            </section>
                        @endif
                        {{-- /Alert --}}

                    </div>
                </div>
            </div>
        </section>
        {{-- /Showcase --}}

        {{-- Paginate --}}
        @if (!$empty)
            <section class="container">
                <div class="row">
                    <div class="col">
                        <div class="actions d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{-- /Paginate --}}

    </section>
@endsection
