@extends('layouts.app')

@section('content')
<section id="products-show">
	<div class="container">
		{{-- Header --}}
		<div class="s-header row py-4">
            <div class="col-1 px-0">
                <a class="align-self-start"
                @if (strpos(url()->previous(), 'edit'))
                	href="{{ route('products.index') }}"
                @else
					href="{{ url()->previous() }}"
                @endif
                ><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back"></a>
            </div>
            <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                <h1 class="title-tec">
                    {{ __($product->name) }}
                </h1>
            </div>
        </div>
		{{-- /Header --}}

		{{-- Presentation --}}
		<div class="s-presentation row">
			<div class="col-9">
				<div class="card border-0 shadow">
					<div class="card-header p-0">
						<img src="{{ $product->get_image }}" class="card-img-top" alt="{{ __('Product image') }}">
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
                    <div class="text-center text-uppercase {{ $color }}">
                        <span class="text-white">{{ $product->category }}</span><br>
                    </div>
					<div class="card-body">
						<b>{{ __('Description').':' }}</b><br>
						{{ __($product->description) }}
					</div>
				</div>
			</div>
			<div class="col">
                @if($errors->all())
                    <div class="card mb-4">
                        <div class="card-header text-center bg-danger text-white">
                            {{ __('Error') }}
                        </div>
                        <div class="card-body text-center bg-danger text-white">
                            @foreach($errors->all() as $error)
                                <b>{{ $error }}</b>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(Session::has('status'))
                    <div class="card mb-4">
                        <div class="card-header text-center bg-success text-white">
                            <b>{{ Session::get('status', 'default') }}</b>
                        </div>
                    </div>
                @endif
				<div class="card">
					<div class="card-header price">
						<span><b>{{ \App\Helpers\Formatters::priceFormatter($product->price) }}</b></span>
					</div>
					<div class="card-body">
						<div class="container">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('shoppingCarts.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input v-model="quantity" type="number" name="amount" class="form-control" placeholder="{{ __('Quantity') }}">
                                        <button class="btn btn-primary btn-block mt-2">{{ __('Add to car') }}</button>
                                    </form>
                                    @if (Auth::user()->isAdmin)
                                        <a class="btn btn-success btn-block mt-2" href="{{ route('products.edit',$product) }}">{{ __('Edit') }}</a>
                                        <form class="mt-2" action="{{ route('products.destroy',$product) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block">{{ __('Delete') }}</button>
                                        </form>
                                        @if(!$product->isEnabled)
                                            <div class="card bg-warning mt-2">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-exclamation-triangle"></i> {{ __('Disabled!') }}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		{{-- /Presentation --}}
	</div>
</section>
@endsection
