@extends('layouts.app')

@section('content')
@include('products.modals.actions')

    <section class="container-fluid scene-cobweb">

        {{-- Header --}}
        <section class="container">
            <div class="row py-4">
                <div class="col text-center">
                    <a href="{{ route('control_panel') }}"><img class="img-fluid stamp hvr-grow" src="{{ asset('images/main/back_icon.png') }}" alt="@lang('back icon')"></a>
                </div>
                <div class="col text-center">
                    <h1><b>@lang('products.titles.index')</b></h1>
                </div>
                <div class="col text-center">
                    <a class="hvr-pulse-grow" data-toggle="modal" data-target="#actionsModal"><i class="fas fa-database fa-2x text-dark"></i></a>
                </div>
            </div>
        </section>
        {{-- /Header --}}

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

        {{-- Messages --}}
        <section class="container">
            <div class="row">
                <div class="col">
                    @if (session()->has('message'))
                        <div class="alert alert-success mt-3 shadow" role="alert">
                            <h3 class="text-center my-0">{{ session('message') }}
                            @if (session()->has('link'))
                                <a href="{{ route('exports.index') }}"> @lang('check it here')</a>
                            @endif
                            </h3>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        {{-- /Messages --}}

        @if (count($products) == 0)

            {{-- Alert --}}
            <section class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-primary mt-3 shadow" role="alert">
                                    @lang('dic.var.empty_table', ['model' => trans('products')])
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <a class="hvr-icon-spin text-dark br-white"><i class="fas fa-10x fa-box-open hvr-icon"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- /Alert --}}

        @else
        {{-- Table --}}
        <section class="container">
            <div class="row">
                <table class="table table-striped shadow table-light">
                    <thead>
                        <tr>
                            <th scope="col">
                                {{ ucfirst(trans('id')) }}
                            </th>
                            <th scope="col" class="text-center">
                                {{ ucfirst(trans('enabled')) }}
                            </th>
                            <th class="text-left" scope="col">
                                {{ ucfirst(trans('name')) }}
                            </th>
                            <th scope="col" class="text-center">
                                {{ ucfirst(trans('category')) }}
                            </th>
                            <th scope="col" class="text-center">
                                {{ ucfirst(trans('price')) }}
                            </th>
                            <th scope="col" class="text-center">
                                {{ ucfirst(trans('stock')) }}
                            </th>
                            <th scope="col">
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($products as $product)
                            <tr>
                                <th scope="row" class="align-middle">
                                    {{ $product->id }}
                                </th>
                                <td class="align-middle text-center">
                                     @if($product->is_enabled)
                                        <span><i class="fas fa-check fa-2x text-success br-green"></i></span>
                                    @else
                                        <span><i class="fas fa-exclamation-triangle fa-2x text-warning br-black"></i></span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{ $product->name }}
                                </td>
                                <td class="align-middle text-center">
                                    @switch($product->category)
                                        @case('computer')
                                            <?php $color = 'br-computer' ?>
                                            @break
                                        @case('smartphone')
                                            <?php $color = 'br-smartphone' ?>
                                            @break
                                        @case('accessory')
                                            <?php $color = 'br-accessory' ?>
                                            @break
                                        @default
                                            <?php $color = 'br-danger' ?>
                                    @endswitch

                                    <span class="p-2 text-bold {{ $color }} text-white">
                                        {{ __($product->category) }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    {{ App\Helpers\Formatters::priceFormatter($product->price) }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $product->stock }}
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-tec" href="{{ route('products.show',$product) }}">@lang('see in shop')</a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        {{-- /Table --}}

        {{-- Paginate --}}
        <section class="container">
            <div class="row">
                <div class="col">
                    <div class="actions d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </section>
        {{-- /Paginate --}}
        @endif

    </section>
@endsection
