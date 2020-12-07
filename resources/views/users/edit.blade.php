@extends('layouts.app')

@section('content')
    <section id="users-edit" class="scene-wall">
        <div class="container">

            {{-- Header --}}
            <div class="s-header row py-4">
                <div class="col-1 px-0">
                     <a class="align-self-start" href="{{ route('users.show',$user) }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
                </div>
                <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                    <h1 class="title-tec">
                        @lang('users.titles.edit')
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
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('users.update',$user) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="text-md-left" for="name">
                                                @lang('users.fields.name'):
                                            </label>
                                            <input id="name" class="form-control" name="name" type="text" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group col">
                                            <label class="text-md-left" for="surname">
                                                @lang('users.fields.surname'):
                                            </label>
                                            <input id="surname" class="form-control" name="surname" type="text" value="{{ $user->surname }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="text-md-left" for="email">
                                                @lang('users.fields.email'):
                                            </label>
                                            <input id="email" class="form-control" name="email" type="text" value="{{ $user->email }}">
                                        </div>
                                        <div class="form-group col">
                                            <label class="text-md-left" for="mobile">
                                                @lang('users.fields.mobile'):
                                            </label>
                                            <input id="mobile" class="form-control" name="mobile" type="text" value="{{ $user->mobile }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="text-md-left" for="document-type">
                                                @lang('users.fields.dt'):
                                            </label>
                                            <select id="document-type" name="document-type" class="form-control">
                                                    <option @if($user->documentType == null) selected @endif>Selecciona el tipo de documento</option>
                                                    <optgroup label="Colombia">
                                                        <option value="CC" @if($user->documentType == 'CC') selected @endif>Cédula de ciudadanía</option>
                                                        <option value="CE" @if($user->documentType == 'CE') selected @endif>Cédula de extranjería</option>
                                                        <option value="TI" @if($user->documentType == 'TI') selected @endif>Tarjeta identidad</option>
                                                        <option value="NIT" @if($user->documentType == 'NIT') selected @endif>NIT</option>
                                                        <option value="RUT" @if($user->documentType == 'RUT') selected @endif>RUT</option>
                                                    </optgroup>
                                                    <optgroup label="Internacional">
                                                        <option value="PPN" @if($user->documentType == 'PPN') selected @endif>Pasaporte</option>
                                                        <option value="TAX" @if($user->documentType == 'TAX') selected @endif>TAX</option>
                                                        <option value="LIC" @if($user->documentType == 'LIC') selected @endif>LIC</option>
                                                    </optgroup>
                                                    <optgroup label="Estados Unidos">
                                                        <option value="SSN" @if($user->documentType == 'SSN') selected @endif>Social security number</option>
                                                    </optgroup> <optgroup label="Panamá">
                                                        <option value="CIP" @if($user->documentType == 'CIP') selected @endif>Cédula de identidad personal</option>
                                                    </optgroup> <optgroup label="Brasil">
                                                        <option value="CPF" @if($user->documentType == 'CPF') selected @endif>Cadastro de Pessoas Físicas</option>
                                                    </optgroup> <optgroup label="Ecuador">
                                                        <option value="CI" @if($user->documentType == 'CI') selected @endif>Cédula de identidad</option>
                                                        <option value="RUC" @if($user->documentType == 'RUC') selected @endif>Registro único de contribuyente</option>
                                                    </optgroup> <optgroup label="Perú">
                                                        <option value="DNI" @if($user->documentType == 'DNI') selected @endif>DNI</option>
                                                    </optgroup> <optgroup label="Costa Rica">
                                                        <option value="CRCPF" @if($user->documentType == 'CRCPF') selected @endif>Cédula personal física</option>
                                                        <option value="CPJ" @if($user->documentType == 'CPJ') selected @endif>Cedula personal juridica</option>
                                                        <option value="DIMEX" @if($user->documentType == 'DIMEX') selected @endif>DIMEX - Documento de identificación de Migración y Extranjería</option>
                                                        <option value="DIDI" @if($user->documentType == 'DIDI') selected @endif>DIDI - Documento de identificación de diplomáticos</option>
                                                    </optgroup></select>
                                        </div>
                                        <div class="form-group col">
                                            <label class="text-md-left" for="document">
                                                @lang('users.fields.document'):
                                            </label>
                                            <input id="document" class="form-control" name="document" type="text" value="{{ $user->document }}">
                                        </div>
                                    </div>
                                    @if (!$user->hasRole('admin'))
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input" id="is_enabled" name="is_enabled" type="checkbox" value="1" {{ $user->is_enabled ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="is_enabled">
                                                            @lang('Enabled')
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
                                                @lang('common.actions.update')
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                <div class="col-4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h2>@lang('Roles')</h2>
                                            </div>
                                        </div>
                                        <form action="{{ route('users.update_roles', $user) }}" method="POST">
                                            @csrf @method('PUT')
                                            @foreach($roles as $id => $name)
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input class="custom-control-input" name="rol" id="rol-{{ $id }}" type="radio" value="{{ $id }}" {{ $user->roles->contains($id) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="rol-{{ $id }}">
                                                                    @lang($name)
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <hr>
                                            <div class="row text-center justify-content-center">
                                                <button class="btn btn-danger">@lang('common.sentences.update_roles')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
