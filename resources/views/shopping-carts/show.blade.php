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
                                                {{ $product->price }}
                                            </td>
                                            <td scope="col" class="text-center">
                                                <form action="{{ route('shopping-cart.edit', $shoppingCart) }}">
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
                                            {{ $shoppingCart->totalPrice }}
                                        </th>
                                        <th scope="col" class="text-center">
                                            <form action="{{ route('shopping-cart.destroy',$shoppingCart) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-danger btn-block">{{ __('Clean') }}</button>
                                            </form>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                </div>
            </div>
            <div class="col bg-tec">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-outline-danger btn-block" href="{{ route('payment',Auth::user()->shoppingCart) }}">{{ __('Pay') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection
