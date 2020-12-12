@extends('layouts.app')

@section('content')

<section class="container-fluid main">
    <div class="row main">
        <div class="col-md-8 scene-wall">
            <div class="row justify-content-center mt-3">
                <h1 class="mb-0"><b>{{ ucwords(trans('shopping cart')) }}</b></h1>
            </div>
            <div class="container mt-3">
                    <div class="s-table">
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
                                            {{ App\Helpers\Formatters::priceFormatter($product->price) }}
                                        </td>
                                        @if ($product->id == $product_id)
                                        <td scope="col" class="text-center">
                                            <span class="rounded-pill p-2 bg-tec text-white">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </td>
                                        @else
                                        <td scope="col" class="text-center">
                                            <form action="{{ route('shoppingCarts.edit', $shoppingCart) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="btn btn-info">{{ ucfirst(trans('edit')) }}</button>
                                            </form>
                                        </td>
                                        @endif
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
                                        {{ App\Helpers\Formatters::priceFormatter($shoppingCart->totalPrice) }}
                                    </th>
                                    <th scope="col" class="text-center">
                                        <form action="{{ route('shoppingCarts.clean', $shoppingCart) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-danger btn-block">{{ ucfirst(trans('clean')) }}</button>
                                        </form>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>
        <div class="col bg-tec hole">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="mb-0 mt-4 text-danger text-center">{{ ucfirst(trans('edit')) }}</h1>
                        <p class="text-white text-center">{{ ucfirst(trans('remember to confirm the changes before clicking buy')) }}</p>
                        <p class="text-success text-center"><b>{{ \App\Product::find($product_id)->name }}</b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="{{ route('shoppingCarts.update',$shoppingCart) }}" method="POST">
                            @csrf @method('PATCH')
                            <div class="form-row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <label for="amount" class="text-white mb-0">
                                        {{ ucfirst(trans('amount')).':' }}
                                    </label>
                                </div>
                                <div class="col">
                                    <input id="amount" type="number" class="form-control" name="amount" value="{{ $shoppingCart->products->where('id',$product_id)->first()->pivot->amount }}">
                                    <input type="hidden" name="product_id" value="{{ \App\Product::find($product_id)->id }}">
                                </div>
                            </div>
                            @if (Session::has('error'))
                                <div class="row">
                                    <div class="col">
                                        <p class="text-white text-center"><b>{{ Session::get('error', 'default') }}</b></p>
                                    </div>
                                </div>
                            @endif
                            <div class="row mb-4">
                                <div class="col">
                                    <button class="btn btn-outline-success btn-block">{{ ucfirst(trans('confirm')) }}</button>
                                </div>
                                <div class="col">
                                    <a class="btn btn-outline-warning btn-block" href="{{ route('shoppingCarts.show', $shoppingCart) }}">{{ ucfirst(trans('cancel')) }}</a>
                                </div>
                            </div>
                        </form>
                        <div class="col p-0">
                            <form action="{{ route('shoppingCarts.update',$shoppingCart) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="product_id" value="{{ \App\Product::find($product_id)->id }}">
                                <button type="submit" class="btn btn-outline-danger btn-block">{{ ucfirst(trans('delete')) }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <img class="img-fluid" src="{{ asset('images/main/PlacetoPayLogo.png') }}" alt="Place to pay logo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
