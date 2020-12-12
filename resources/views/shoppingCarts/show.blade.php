@extends('layouts.app')

@section('content')

    <section class="container-fluid main">
        <div class="row main">
            <div class="col-md-8 scene-cobweb-base">
                <div class="row justify-content-center mt-3">
                    <h1 class="mb-0"><b>{{ ucwords(trans('shopping cart')) }}</b></h1>
                </div>
                <div class="container mt-3">
                        <div class="s-table">
                            @if ($shoppingCart->amount != 0)
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr class="bg-tec">
                                        <th scope="col">
                                            {{ ucfirst(trans('product')) }}
                                        </th>
                                        <th scope="col" class="text-center">
                                            {{ ucfirst(trans('amount')) }}
                                        </th>
                                        <th scope="col" class="text-center">
                                            {{ ucfirst(trans('price')) }}
                                        </th>
                                        <th scope="col">
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shoppingCart->products as $product)
                                        <tr>
                                            <td scope="col">
                                                {{ $product->name }}
                                            </td>
                                            <td scope="col" class="text-center">
                                                {{ $product->pivot->amount }}
                                            </td>
                                            <td scope="col" class="text-center">
                                                {{ \App\Helpers\Formatters::priceFormatter($product->price) }}
                                            </td>
                                            <td scope="col" class="text-center">
                                                <form action="{{ route('shoppingCarts.edit', $shoppingCart) }}">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button class="btn btn-info">{{ ucfirst(trans('edit')) }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <thead>
                                    <tr class="bg-tec">
                                        <th scope="col">
                                            {{ ucfirst(trans('total')) }}
                                        </th>
                                        <th scope="col" class="text-center">
                                            {{ $shoppingCart->amount }}
                                        </th>
                                        <th scope="col" class="text-center">
                                            {{ \App\Helpers\Formatters::priceFormatter($shoppingCart->totalPrice) }}
                                        </th>
                                        <th scope="col" class="text-center">
                                            <form action="{{ route('shoppingCarts.clean',$shoppingCart) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-danger btn-block">{{ ucfirst(trans('clean')) }}</button>
                                            </form>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <div class="card bg-tec text-center my-5 hvr-wobble-vertical">
                                            <div class="card-header text-white text-uppercase">
                                                <b>{{ ucfirst(trans(('your shopping cart is empty'))) }}</b>

                                            </div>
                                            <div class="card-body text-white">
                                                <p>{{ ucfirst(trans(('go to the store and buy products'))).'!' }}</p>
                                                <p>{{ ucfirst(trans(('offers are for a limited time'))) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
            <div class="col bg-tec hole">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <img class="img-fluid" src="{{ asset('images/main/PlacetoPayLogo.png') }}" alt="@lang('dic.pp2.lg')">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-white text-center">{{ ucfirst(trans('dic.pp2.desc')).'.' }}</p>
                        </div>
                    </div>
                    @if ($shoppingCart->amount != 0)
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('payment', ['shopping_cart_id' => Auth::user()->shoppingCart->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-block">{{ ucfirst(trans('pay')) }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-outline-success btn-block" href="{{ route('shop') }}">{{ ucfirst(trans('go to shop')) }}</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
