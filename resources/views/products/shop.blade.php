@extends('layouts.app')

@section('content')
	<div id="products-shop" class="container">
		{{-- Showcase --}}
		<div class="s-showcase container">
			<div class="row">
				@foreach($products as $product)
				<div class="col-md-4">
					<form action="{{ route('products.show',$product) }}">
						<button class="card px-0 mask flex-center shadow">
							<div class="card-header">
								<img class="img-fluid" src="{{ $product->get_image }}" alt="Imagen de producto">
							</div>
							<div class="card-body d-flex flex-md-column">
								<div class="align-self-start">
									<span><b>${{ $product->price }}</b></span><br>
								</div>
								<div class="div">
									{{ $product->name }}
								</div>
							</div>
						</button>
					</form>
				</div>
				@endforeach
			</div>
		</div>
		{{-- /Showcase --}}
		<div class="actions d-flex justify-content-center">
			{{ $products->links() }}
		</div>
	</div>
@endsection