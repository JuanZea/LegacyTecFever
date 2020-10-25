@extends('layouts.app')

@section('content')
<section id="shoppingCart-index">
    {{--Main--}}
    <div class="container-fluid">
        <div class="row">
            <div id="summary" class="col-md-8">
                <div class="row justify-content-center mt-3">
                    <h1 class="mb-0"><b>{{ __('Shopping Cart') }}</b></h1>
                </div>
                <div class="container mt-3">
                        <div class="s-table">
                            @if ($shoppingCart->amount != 0)
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr class="bg-tec">
                                        <th scope="col">
                                            {{ __('Product') }}
                                        </th>
                                        <th scope="col" class="text-center">
                                            {{ __('Amount') }}
                                        </th>
                                        <th scope="col" class="text-center">
                                            {{ __('Price') }}
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
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button class="btn btn-info">{{ __('Edit') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <thead>
                                    <tr class="bg-tec">
                                        <th scope="col">
                                            {{ __('Total') }}
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
                                                <button class="btn btn-danger btn-block">{{ __('Clean') }}</button>
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
                                                <b>{{ __('Your shopping cart is empty') }}</b>
                                            </div>
                                            <div class="card-body text-white">
                                                <p>{{ __('Go to the store and buy products!') }}</p>
                                                <p>{{ __('Offers are for a limited time') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
            <div class="col bg-tec">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <img class="img-fluid" src="{{ asset('images/main/PlacetoPayLogo.png') }}" alt="Place to pay logo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-white text-center">{{ __('The most complete solution to accompany your digital transaction processes in different channels, with the highest security and functionalities that adapt to the needs of your business to make it grow. Now backed by Evertec.') }}</p>
                        </div>
                    </div>
                    @if ($shoppingCart->amount != 0)
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-outline-danger btn-block" href="{{ route('payment', ['shopping_cart_id' => Auth::user()->shoppingCart->id]) }}">{{ __('Pay') }}</a>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-outline-success btn-block" href="{{ route('shop') }}">{{ __('Go to shop') }}</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection
