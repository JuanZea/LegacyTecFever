@extends('layouts.app')

@section('content')

    <section class="container-fluid scene-wall">

        {{-- Header --}}
        <section class="container">
            <div class="row py-4">
                <div class="col text-center">
                     <a href="{{ route('users.show',$user) }}"><img class="img-fluid stamp" src="{{ asset('images/main/back_icon.png') }}" alt="@lang('back icon')"></a>
                </div>
                <div class="col text-center">
                    <h1><b>{{ ucwords(trans('users.titles.edit')) }}</b></h1>
                </div>
                <div class="col"></div>
            </div>
        </section>
        {{-- /Header --}}

        {{-- Errors --}}
        @if (session()->has('errors'))
            <section class="container my-4">
                <div class="row">
                    <div class="col">
                        <div class="alert alert-danger text-center shadow m-0" role="alert">
                            {{ ucfirst(trans('users.errors.updated')) }}
                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{-- /Errors --}}

        {{-- Form --}}
        <section class="container pb-4">
            <div class="row mt-4">
                <div class="col">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('users.update',$user) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="text-md-left" for="name">
                                            {{ ucfirst(trans('name')).':' }}
                                        </label>
                                        <input id="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" name="name" type="text" value="{{ old('name', $user->name) }}">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label class="text-md-left" for="surname">
                                            {{ ucfirst(trans('surname')).':' }}
                                        </label>
                                        <input id="surname" class="form-control {{ $errors->first('surname') ? 'is-invalid' : '' }}" name="surname" type="text" value="{{ old('surname', $user->surname) }}">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('surname') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="text-md-left" for="email">
                                            {{ ucfirst(trans('email')).':' }}
                                        </label>
                                        <input id="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" name="email" type="text" value="{{ old('email', $user->email) }}">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label class="text-md-left" for="mobile">
                                            {{ ucfirst(trans('mobile')).':' }}
                                        </label>
                                        <input id="mobile" class="form-control {{ $errors->first('mobile') ? 'is-invalid' : '' }}" name="mobile" type="text" value="{{ old('mobile', $user->mobile) }}">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('mobile') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="text-md-left" for="document_type">
                                            {{ ucfirst(trans('document type')).':' }}
                                        </label>
                                        <select id="document_type" name="document_type" class="form-control {{ $errors->first('document_type') ? 'is-invalid' : '' }}">
                                            <option @if($user->document_type == null) selected @endif>Selecciona el tipo de documento</option>
                                            <optgroup label="Colombia">
                                                <option value="CC" @if($user->document_type == 'CC') selected @endif>Cédula de ciudadanía</option>
                                                <option value="CE" @if($user->document_type == 'CE') selected @endif>Cédula de extranjería</option>
                                                <option value="TI" @if($user->document_type == 'TI') selected @endif>Tarjeta identidad</option>
                                                <option value="NIT" @if($user->document_type == 'NIT') selected @endif>NIT</option>
                                                <option value="RUT" @if($user->document_type == 'RUT') selected @endif>RUT</option>
                                            </optgroup>
                                            <optgroup label="Internacional">
                                                <option value="PPN" @if($user->document_type == 'PPN') selected @endif>Pasaporte</option>
                                                <option value="TAX" @if($user->document_type == 'TAX') selected @endif>TAX</option>
                                                <option value="LIC" @if($user->document_type == 'LIC') selected @endif>LIC</option>
                                            </optgroup>
                                            <optgroup label="Estados Unidos">
                                                <option value="SSN" @if($user->document_type == 'SSN') selected @endif>Social security number</option>
                                            </optgroup> <optgroup label="Panamá">
                                                <option value="CIP" @if($user->document_type == 'CIP') selected @endif>Cédula de identidad personal</option>
                                            </optgroup> <optgroup label="Brasil">
                                                <option value="CPF" @if($user->document_type == 'CPF') selected @endif>Cadastro de Pessoas Físicas</option>
                                            </optgroup> <optgroup label="Ecuador">
                                                <option value="CI" @if($user->document_type == 'CI') selected @endif>Cédula de identidad</option>
                                                <option value="RUC" @if($user->document_type == 'RUC') selected @endif>Registro único de contribuyente</option>
                                            </optgroup> <optgroup label="Perú">
                                                <option value="DNI" @if($user->document_type == 'DNI') selected @endif>DNI</option>
                                            </optgroup> <optgroup label="Costa Rica">
                                                <option value="CRCPF" @if($user->document_type == 'CRCPF') selected @endif>Cédula personal física</option>
                                                <option value="CPJ" @if($user->document_type == 'CPJ') selected @endif>Cedula personal juridica</option>
                                                <option value="DIMEX" @if($user->document_type == 'DIMEX') selected @endif>DIMEX - Documento de identificación de Migración y Extranjería</option>
                                                <option value="DIDI" @if($user->document_type == 'DIDI') selected @endif>DIDI - Documento de identificación de diplomáticos</option>
                                            </optgroup>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('document_type') }}
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label class="text-md-left" for="document">
                                            {{ ucfirst(trans('document')).':' }}
                                        </label>
                                        <input id="document" class="form-control {{ $errors->first('document') ? 'is-invalid' : '' }}" name="document" type="text" value="{{ old('document', $user->document) }}">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('document') }}
                                        </div>
                                    </div>
                                </div>
                                @if (!$user->hasRole('admin'))
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input class="custom-control-input" id="is_enabled" name="is_enabled" type="checkbox" value="1" {{ $user->is_enabled ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="is_enabled">
                                                        {{ ucfirst(trans('enabled')) }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 col-md-3">
                                         <input name="permission" type="hidden" value="1">
                                        <button class="btn btn-block btn-danger">
                                            {{ ucfirst(trans('update')) }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                            <div class="col-4">
                                <div class="container">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h2>{{ ucfirst(trans('roles')) }}</h2>
                                        </div>
                                    </div>
                                    <form action="{{ route('users.update_roles', $user) }}" method="POST">
                                        @csrf @method('PUT')
                                        @foreach($roles as $id => $rol_name)
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" name="rol" id="rol-{{ $id }}" type="radio" value="{{ $id }}" {{ $user->roles->contains($id) ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="rol-{{ $id }}">
                                                                {{ ucfirst(trans($rol_name)) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <hr>
                                        <div class="row text-center justify-content-center">
                                            <button class="btn btn-danger">{{ ucfirst(trans('update roles')) }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /Form --}}
    </section>
@endsection
