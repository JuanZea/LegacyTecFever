@extends('layouts.app')

@section('content')
<section id="products-index">
    <div class="container">
        {{-- Header --}}
        <div class="s-header row py-4 d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ route('controlPanel') }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
                </div>
                <div>
                    <h1 class="title-tec"><i class="fas fa-desktop px-2"></i></i>{{ __('Products Management') }}</h1>
                </div>
                <div>
                    <a href="{{ route('products.create') }}"><i class="fas fa-plus-circle"></i></a>
                </div>
            </div>
        {{-- /Header --}}

        {{-- Table --}}
        <div class="s-table row">
            <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">
                            {{ __('Id') }}
                        </th>
                        <th class="text-left" scope="col">
                            {{ __('Name') }}
                        </th>
                        <th scope="col">
                            {{ __('Category') }}
                        </th>
                        <th scope="col">
                            {{ __('Price') }}
                        </th>
                        <th scope="col">
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($products as $product)
                        <tr>
                            <th scope="row">
                                {{ $product->id }}
                            </th>
                            <td class="text-left">
                                {{ $product->name }}
                            </td>
                            <td>
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

                                <span class="rounded-pill p-2 {{ $color }} text-white">
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td>
                                {{ $product->price }}
                            </td>
                            {{-- <td>
                                <form action="{{ route('products.destroy',$product) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger">Eliminar</button>
                                </form>
                            </td> --}}
                            <td>
                                <a class="btn btn-tec" href="{{ route('products.show',$product) }}">{{ __('See in shop') }}</a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        {{-- /Table --}}
        </div>
        <div class="actions d-flex justify-content-center">
                {{ $products->links() }}
            </div>
    </div>
</section>
@endsection
