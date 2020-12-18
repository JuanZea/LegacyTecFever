@extends('layouts.app')

@section('content')
    <section class="container-fluid scene-wall">
		{{-- Header --}}
		<section class="container">
            <div class="row py-4">
                <div class="col px-0">
                    @if (request('back_url'))
                        <a href="{{ request('back_url') }}"><img class="img-fluid stamp hvr-grow" src="{{ asset('images/main/back_icon.png') }}" alt="@lang('back icon')"></a>
                    @else
                        <a href="{{ url()->previous() }}"><img class="img-fluid stamp hvr-grow" src="{{ asset('images/main/back_icon.png') }}" alt="@lang('back icon')"></a>
                    @endif
                </div>
                <div class="col text-center">
                    <h1><b>{{ $product->name }}</b></h1>
                </div>
                <div class="col"></div>
            </div>
        </section>
		{{-- /Header --}}

		{{-- Presentation --}}
		<section class="container pb-5">
            <div class="row">
                <div class="col-8">
                    <div class="card border-0 shadow">
                        <div class="card-header p-0">
                            <img src="{{ $product->get_image }}" class="card-img-top img-fluid" alt="@lang('product image')">
                        </div>
                        @switch($product->category)
                            @case('computer')
                            <?php $color = 'bg-computer' ?>
                            @break
                            @case('smartphone')
                            <?php $color = 'bg-smartphone' ?>
                            @break
                            @case('accessory')
                            <?php $color = 'bg-accessory' ?>
                            @break
                            @default
                            <?php $color = 'bg-danger' ?>
                        @endswitch
                        <div class="text-center text-uppercase hole {{ $color }}">
                            <span class="text-white">@lang($product->category)</span><br>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">{{ ucfirst(trans('description')) }}</p>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">

                    {{-- Errors --}}
                    @if(session()->has('errors'))
                        <section class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger mt-3 shadow" role="alert">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $message)
                                                <ul><h3 class="text-center my-0">{{ $message }}</h3></ul>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                    {{-- /Errors --}}

                    {{-- /Disabled --}}
                    @if(Auth::user()->hasRole('admin') && !$product->is_enabled)
                        <section class="container mb-4">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-warning text-center shadow m-0" role="alert">
                                        {{ strtoupper(trans('disabled')) }}
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                    {{-- /Disabled --}}

                    {{-- Messages --}}
                    @if(Session::has('message'))
                        <section class="container mb-4">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-success text-center shadow m-0" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                    {{-- /Messages --}}

                    <div class="price text-center">
                        <span class="hvr-buzz-out"><b>{{ \App\Helpers\Formatters::priceFormatter($product->price) }}</b></span>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        @if (config('app.locale') == 'en')
                            <img class="img-fluid stamp ani-grow" src="{{ asset('images/main/buy.png') }}" alt="@lang('buy')">
                        @else
                            <img class="img-fluid stamp ani-grow" src="{{ asset('images/main/comprar.png') }}" alt="@lang('buy')">
                        @endif
                    </div>
                    <div class="row mt-2 justify-content-center">
                        <form action="{{ route('shoppingCarts.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-row">
                                <input v-model="quantity" type="number" name="amount" class="form-control" placeholder="@lang('quantity')">
                            </div>
                            <div class="form-row justify-content-center">
                                <button class="btn btn-outline-danger btn-lg mt-2">@lang('add to car')</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    @if (Auth::user()->hasRole('admin'))
                        <section class="container">
                            <div class="row">
                                <div class="col text-center">
                                    <a href="{{ route('products.edit', ['product' => $product, 'back_url' => request('back_url') ? request('back_url') : url()->previous()]) }}" class="text-warning br-black"><i class="fas fa-pencil-alt fa-3x hvr-grow" data-toggle="tooltip" data-placement="bottom" title="Importar productos"></i></a>
                                </div>
                                <div class="col text-center">
                                   <form action="{{ route('products.destroy',$product) }}" method="POST" onclick="return confirm('¿Estás seguro?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-danger br-black button-naked"><i class="fas fa-trash-alt fa-3x hvr-grow" data-toggle="tooltip" data-placement="bottom" title="@lang('common.actions.delete')"></i></button>
                                    </form>
                                </div>
                            </div>
                        </section>
                    @endif
                    <hr>
                    <section class="container mt-5">
                        <div class="text-center mt-4">
                            <h2><b>@lang('views')</b></h2>
                        </div>
                        <div class="views text-center">
                            <span class="hvr-grow"><b>{{ \GuzzleHttp\json_decode($product->stats, true)['views'] }}</b></span>
                        </div>
                        <div class="text-center mt-4">
                            <h2 class="mb-0"><b>@lang('sales')</b></h2>
                        </div>
                        <div class="views text-center">
                            <span class="hvr-grow"><b>{{ \GuzzleHttp\json_decode($product->stats, true)['sales'] }}</b></span>
                        </div>
                    </section>
                </div>
            </div>
        </section>
		{{-- /Presentation --}}

    </section>

@endsection
