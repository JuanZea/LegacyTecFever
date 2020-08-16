@extends('layouts.app')

@section('content')
	<div id="products-shop">
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
				<div class="col-md-4 py-3">
					<form action="{{ route('products.show',$product) }}">
						<button class="card px-0 mask shadow">
							<div class="card-header">
								<img class="img-fluid" src="{{ $product->get_image }}" alt="Imagen de producto">
							</div>
							<div class="card-body d-flex flex-md-column justify-content-between">
								<div class="div">
									{{ $product->name }}
								</div>
								<div class="align-self-center price">
									<span><b>${{ $product->price }}</b></span><br>
								</div>
							</div>
						</button>
					</form>
				</div>
				@endforeach
			</div>
		</div>
		<div class="actions d-flex justify-content-center">
			{{ $products->links() }}
		</div>
		{{-- /Showcase --}}

	</div>
@endsection
