@extends('layouts.app')

@section('content')
@include('products.modals.actions')
<section id="products-index" class="scene-cobweb">
    <div class="container">
        {{-- Header --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-3" role="alert">
                <ul>
                    @foreach($errors->all() as $message)
                        <ul>{{ __($message) }}</ul>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="s-header row py-4 d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ route('control_panel') }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
                </div>
                <div>
                    <h1 class="title-tec"><i class="fas fa-desktop px-2"></i></i>@lang('products.titles.index')</h1>
                </div>
                <div>
                    <a class="hvr-pulse-grow" data-toggle="modal" data-target="#actionsModal"><i class="fas fa-database br-black"></i></a>
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
                        <th scope="col">
                            @lang('common.fields.enabled')
                        </th>
                        <th class="text-left" scope="col">
                            @lang('common.fields.name')
                        </th>
                        <th scope="col">
                            @lang('common.fields.category')
                        </th>
                        <th scope="col">
                            @lang('common.fields.price')
                        </th>
                        <th scope="col">
                            @lang('common.fields.stock')
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
                            <td class="s-status text-center">
                                 @if($product->is_enabled)
                                    <span><i class="fas fa-check fa-2x text-success br-green"></i></span>
                                @else
                                    <span><i class="fas fa-exclamation-triangle fa-2x text-warning br-black"></i></span>
                                @endif
                            </td>
                            <td class="text-left">
                                {{ $product->name }}
                            </td>
                            <td>
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
                            <td>
                                {{ App\Helpers\Formatters::priceFormatter($product->price) }}
                            </td>
                            <td>
                                {{ $product->stock }}
                            </td>
                            <td>
                                <a class="btn btn-tec" href="{{ route('products.show',$product) }}">{{ __('See in shop') }}</a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        {{-- /Table --}}

        {{-- Paginate --}}
        <div class="actions d-flex justify-content-center">
            {{ $products->links() }}
        </div>
        {{-- /Paginate --}}

    </div>
</section>
@endsection
