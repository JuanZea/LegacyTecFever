@extends('layouts.app')

@section('content')
<section id="products-edit" class="scene-wall">
	<div class="container">

		{{-- Header --}}
		<div class="s-header row py-4">
            <div class="col-1 px-0">
                    <a class="align-self-start" href="{{ route('products.show',$product) }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
            </div>
            <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                <h1 class="title-tec">
                    @lang('products.titles.update')
                </h1>
            </div>
        </div>
		{{-- /Header --}}

        {{-- Form --}}
		<div class="row">
			<div class="col">
				<form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
				    <div class="form-row">
                        <div class="form-group col-md-8">
				            <label for="name">@lang('common.fields.name')</label>
				            <input name="name" type="text" class="form-control
				            @if ($errors->first('name'))
                                {{ 'is-invalid' }}
                            @endif
				            sizer" id="name" value="{{ old('name',$product->name) }}">
                            <div class="invalid-feedback">
				                {{ __($errors->first('name')) }}
				            </div>
                        </div>
                        <div class="form-group col">
                            <label for="price">@lang('common.fields.price')</label>
                            <input name="price" type="number" class="form-control
                            @if ($errors->first('price'))
                                {{ 'is-invalid' }}
                            @endif
                            sizer" id="price" value="{{ old('price', $product->price) }}">
                            <div class="invalid-feedback">
                                {{ __($errors->first('price')) }}
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="stock">@lang('common.fields.stock')</label>
                            <input name="stock" type="number" class="form-control
                            @if ($errors->first('stock'))
                                {{ 'is-invalid' }}
                            @endif
                            sizer" id="price" value="{{ old('stock', $product->stock) }}">
                            <div class="invalid-feedback">
                                {{ __($errors->first('stock')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="description">@lang('common.fields.description')</label>
                            <textarea class="form-control
                            @if ($errors->first('description'))
                                {{ 'is-invalid' }}
                            @endif
                            sizer" rows="3" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                            <div class="invalid-feedback">
                                {{ __($errors->first('description')) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="category">@lang('common.fields.category')</label>
                                    <select name="category" class="form-control custom-select
                                        @if ($errors->first('category'))
                                            {{ 'is-invalid' }}
                                        @endif
                                        sizer" id="category">
                                        <option value="0" selected>{{ __('computer') }}</option>
                                        <option value="1">{{ __('smartphone') }}</option>
                                        <option value="2">{{ __('accessory') }}</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __($errors->first('category')) }}
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col form-group">
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" id="delete" name="delete" type="checkbox">
                                                <label class="custom-control-label" for="delete">
                                                    {{ __('Delete image') }}
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" id="is_enabled" name="is_enabled" type="checkbox"
                                                @if($product->is_enabled)
                                                    checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="is_enabled">
                                                    {{ __('Enabled product') }}
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block mt-2">@lang('common.actions.update')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="image">@lang('common.fields.image')</label>
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
