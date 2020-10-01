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
                                        <tr
                                        @if ($product->id == $product_id)
                                            class="bg-warning text-dark"
                                        @endif
                                        >
                                            <td scope="col">
                                                {{ $product->name }}
                                            </td>
                                            <td scope="col" class="text-center">
                                                {{ $product->pivot->amount }}
                                            </td>
                                            <td scope="col" class="text-center">
                                                {{ $product->price }}
                                            </td>
                                            @if ($product->id == $product_id)
                                            <td scope="col" class="text-center">
                                                <span class="rounded-pill p-2 bg-tec text-white">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </span>
                                            </td>
                                            @else
                                            <td scope="col" class="text-center">
                                                <form action="{{ route('shopping-cart.edit', $shoppingCart) }}">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button class="btn btn-info">{{ __('Edit') }}</button>
                                                </form>
                                            </td>
                                            @endif
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
                            <h1 class="mb-0 text-danger text-center">{{ __('Edit') }}</h1>
                            <p class="text-white text-center">{{ __('Remember to save the changes before clicking buy') }}</p>
                            <p class="text-success text-center"><b>{{ \App\Product::find($product_id)->name }}</b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('shopping-cart.update',$shoppingCart) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="form-row mb-4">
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <label for="amount" class="text-white mb-0">
                                            {{ __('Amount:') }}
                                        </label>
                                    </div>
                                    <div class="col">
                                        <input id="amount" type="number" class="form-control" name="amount" value="{{ $shoppingCart->products->where('id',$product_id)->first()->pivot->amount }}">
                                        <input type="hidden" name="product_id" value="{{ \App\Product::find($product_id)->id }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <button class="btn btn-outline-success btn-block">{{ __('Confirm') }}</button>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-outline-warning btn-block" href="{{ route('shopping-cart.show', $shoppingCart) }}">{{ __('Cancel') }}</a>
                                    </div>
                                    <div class="col">
                            </form>
                                        <form action="{{ route('shopping-cart.update',$shoppingCart) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="product_id" value="{{ \App\Product::find($product_id)->id }}">
                                            <button class="btn btn-outline-danger btn-block">{{ __('Delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
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
