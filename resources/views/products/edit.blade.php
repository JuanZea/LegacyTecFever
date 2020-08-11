@extends('layouts.app')

@section('content')
<section id="products-edit">
	<div class="container">
		{{-- Header --}}
		<div class="s-header row py-4">
            <div class="col-1 px-0">
                    <a class="align-self-start" href="{{ route('products.show',$product) }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
            </div>
            <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                <h1 class="title-tec">
                    {{ __('Edit Menu') }}
                </h1>
            </div>
        </div>
		{{-- /Header --}}
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
			<form action="{{ route('products.update',$product) }}" method="POST" enctype="multipart/form-data">
				@csrf @method('PUT')
			  <div class="form-row">
				    <div class="form-group col-md-9">
				      <label for="name">{{ __('Name') }}</label>
				      <input name="name" type="text" class="form-control sizer
				      @if ($errors->first('name'))
				      	{{ 'is-invalid' }}
				      @endif
				      " id="name" value="{{ old('name',$product->name) }}">
				      <div class="invalid-feedback">
				        {{ __('Please provide a valid name.') }}
				      </div>
				    </div>
				    <div class="form-group col-md-3">
				      <label for="price">{{ __('Price') }}</label>
				      <input name="price" type="number" class="form-control sizer
				      @if ($errors->first('price'))
				      	{{ 'is-invalid' }}
				      @endif
				      " id="price" value="{{ old('price',$product->price) }}">
				    </div>
				  </div>
				  <div class="form-row">
				  	<div class="form-group col-md-9">
				  		<label for="description">{{ __('Description') }}</label>
				      	<textarea class="form-control sizer" rows="5" name="description" id="description">{{ old('description',$product->description) }}</textarea>
				  	</div>
				  	<div class="col-md-3">
				  		<div class="row">
				  			<div class="col form-group">
				  				<label for="category">{{ __('Category') }}</label>
								<select name="category" class="form-control custom-select sizer" id="category">
							    <option selected>{{ __('computer') }}</option>
							    <option>{{ __('smartphone') }}</option>
							    <option>{{ __('accessory') }}</option>
							  	</select>
				  			</div>
				  		</div>
				  		<div class="row">
						    <div class="col form-group">
						    	<button type="submit" class="btn btn-success btn-block">{{ __('Update') }}</button>
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
	</div>
</section>
@endsection