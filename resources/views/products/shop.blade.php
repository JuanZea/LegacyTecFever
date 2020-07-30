@extends('layouts.app')

@section('content')
	<section id="shop" class="container">
		<div class="row">
			@foreach($products as $product)
			<div class="col-3">
				<form action="{{ route('products.show',$product) }}">
					<button class="card px-0 mask flex-center">
						<div class="card-header">
							<img class="img-fluid" src="{{ asset('assets/img/Back.png') }}" alt="Imagen de producto">
						</div>
						<div class="card-body">
							{{ $product->price }}
							{{ $product->name }}
						</div>
					</button>
				</form>
			</div>
			@endforeach
		</div>
		<div class="actions d-flex justify-content-center">
			{{ $products->links() }}
		</div>
	</section>
@endsection