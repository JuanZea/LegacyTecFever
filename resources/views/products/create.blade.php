@extends('layouts.app')

@section('content')
<section id="products-create">
	<div class="container">
		{{-- Header --}}
		<div class="s-header row py-4">
            <div class="col-1 px-0">
                    <a class="align-self-start" href="{{ route('products.index') }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
            </div>
            <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                <h1 class="title-tec">
                    {{ __('Create Menu') }}
                </h1>
            </div>
        </div>
		{{-- /Header --}}

        {{-- Form --}}
		<div class="row">
			<div class="col">
				@if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                    @endif
				<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
				  <div class="form-row">
				    <div class="form-group col-md-9">
				      <label for="name">{{ __('Name') }}</label>
				      <input name="name" type="text" class="form-control sizer" id="name" value="{{ old('name') }}">
				    </div>
				    <div class="form-group col-md-3">
				      <label for="price">{{ __('Price') }}</label>
				      <input name="price" type="number" class="form-control sizer" id="price" value="{{ old('price') }}">
				    </div>
				  </div>
				  <div class="form-row">
				  	<div class="form-group col-md-9">
				  		<label for="description">{{ __('Description') }}</label>
				      	<textarea class="form-control sizer" rows="5" name="description" id="description">{{ old('description') }}</textarea>
				  	</div>
				  	<div class="col-md-3">
				  		<div class="row">
				  			<div class="col form-group">
				  				<label for="category">{{ __('Category') }}</label>
								<select name="category" class="form-control custom-select sizer" id="category">
							    <option value="0" selected>{{ __('computer') }}</option>
							    <option value="1">{{ __('smartphone') }}</option>
							    <option value="2">{{ __('accessory') }}</option>
							  	</select>
				  			</div>
				  		</div>
				  		<div class="row">
						    <div class="col form-group">
						    	<button type="submit" class="btn btn-success btn-block">{{ __('Create') }}</button>
						    </div>
				  		</div>
				    </div>
				  		<div class="form-group col-md-3">
				  		<label for="image">{{ __('Image') }}</label>
							  <input name="image" type="file">
				  		</div>
				  </div>
				</form>
			</div>
		</div>
        {{-- /Form --}}

	</div>
</section>
@endsection
