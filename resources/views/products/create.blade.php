@extends('layouts.app')

@section('content')
    <section class="container-fluid scene-wall">

        {{-- Header --}}
        <section class="container">
            <div class="row py-4">
                <div class="col-1 px-0">
                    <a class="align-self-start" href="{{ route('products.index') }}"><img class="img-fluid stamp hvr-grow" src="{{ asset('images/main/back_icon.png') }}" alt="back icon"></a>
                </div>
                <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                    <h1><b>@lang('products.titles.create')</b></h1>
                </div>
            </div>
        </section>
        {{-- /Header --}}

        {{-- Form --}}
        <section class="container">
            <div class="row">
                <div class="col">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">{{ ucfirst(trans('name')).':' }}</label>
                                <input name="name" type="text" class="form-control
                                @if ($errors->first('name'))
                                    {{ 'is-invalid' }}
                                @endif
                                sizer" id="name" value="{{ old('name') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>
                            <div class="form-group col">
                                <label for="price">{{ ucfirst(trans('price')).':' }}</label>
                                <input name="price" type="number" class="form-control
                                @if ($errors->first('price'))
                                    {{ 'is-invalid' }}
                                @endif
                                sizer" id="price" value="{{ old('price') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            </div>
                            <div class="form-group col">
                                <label for="stock">{{ ucfirst(trans('stock')).':' }}</label>
                                <input name="stock" type="number" class="form-control
                                @if ($errors->first('stock'))
                                    {{ 'is-invalid' }}
                                @endif
                                sizer" id="price" value="{{ old('stock') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('stock') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="description">{{ ucfirst(trans('description')).':' }}</label>
                                <textarea class="form-control
                                @if ($errors->first('description'))
                                    {{ 'is-invalid' }}
                                @endif
                                sizer" rows="3" name="description" id="description">{{ old('description') }}</textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="category">{{ ucfirst(trans('category')).':' }}</label>
                                        <select name="category" class="form-control custom-select
                                            @if ($errors->first('category'))
                                                {{ 'is-invalid' }}
                                            @endif
                                            sizer" id="category">
                                            <option value="0" selected>@lang('computer')</option>
                                            <option value="1">@lang('smartphone')</option>
                                            <option value="2">@lang('accessory')</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('category') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <button type="submit" class="btn btn-success btn-block">{{ ucfirst(trans('create')) }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="image">{{ ucfirst(trans('image')).':' }}</label>
                                <input name="image" type="file">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        {{-- /Form --}}

</section>
@endsection
