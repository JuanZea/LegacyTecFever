@extends('layouts.app')

@section('content')
	<div id="products-shop" class="scene-tesla">
		<div class="container">
		{{-- Header --}}
            <div class="row text-center">
                <div class="col">
                    <img src="{{ asset('images/main/ShopTitle.png') }}" alt="">
                </div>
            </div>
		{{-- /Header --}}

		{{-- Showcase --}}
			<div class="s-showcase row">
				@foreach($products as $product)
				    @if($product->is_enabled)
                        <div class="col-md-4 py-3 hvr-grow-shadow">
                            <form action="{{ route('products.show',$product) }}">
                                <button class="card px-0 mask shadow">
                                    <div class="card-header p-0">
                                        <img class="img-fluid" src="{{ $product->get_image }}" alt="Imagen de producto">
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
                                            <div class="align-self-center {{ $color }}">
                                                <span class="text-white">{{ strtoupper(__($product->category)) }}</span><br>
                                            </div>
                                    <div class="card-body d-flex flex-md-column justify-content-between">
                                        <div class="div">
                                            {{ $product->name }}
                                        </div>
                                            <div class="align-self-center price">
                                                <span><b>{{ \App\Helpers\Formatters::priceFormatter($product->price) }}</b></span><br>
                                            </div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    @endif
                @endforeach
                @if ($empty)
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <h1 class="bg-white rounded-pill">{{ __('There are no products to show') }}</h1>
                            </div>
                        </div>
                    </div>
                @endif
			</div>
		</div>
		<div class="actions d-flex justify-content-center">
			{{ $products->links() }}
		</div>
		{{-- /Showcase --}}

	</div>
@endsection
