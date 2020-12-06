@extends('layouts.app')

@section('content')
    <section id="users-edit">
        <div class="container">
            {{-- Header --}}
            <div class="s-header row py-4">
                <div class="col-1 px-0">
                     <a class="align-self-start" href="{{ route('users.show',$user) }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
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
                    <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('users.update',$user) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="text-md-left" for="name">
                                                {{ __('User name').':' }}
                                            </label>
                                            <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group col">
                                            <label class="text-md-left" for="surname">
                                                {{ __('User surname').':' }}
                                            </label>
                                            <input class="form-control" name="surname" type="text" value="{{ $user->surname }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="text-md-left" for="email">
                                                {{ __('User email').':' }}
                                            </label>
                                            <input class="form-control" name="email" type="text" value="{{ $user->email }}">
                                        </div>
                                        <div class="form-group col">
                                            <label class="text-md-left" for="mobile">
                                                {{ __('User mobile').':' }}
                                            </label>
                                            <input class="form-control" name="mobile" type="text" value="{{ $user->mobile }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="text-md-left" for="document-type">
                                                {{ __('User document type').':' }}
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
                                                {{ __('User document').':' }}
                                            </label>
                                            <input class="form-control" name="document" type="text" value="{{ $user->document }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12 col-md-3">
                                             <input name="permission" type="hidden" value="1">
                                            <button class="btn btn-block btn-danger">
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                <div class="col-4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h2>@lang('common.fields.permissions')</h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                @if(!$user->hasRole('admin'))
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input" id="is_enabled" name="is_enabled" type="checkbox" value="1"
                                                        @if($user->is_enabled)
                                                            checked
                                                        @endif
                                                        >
                                                        <label class="custom-control-label" for="is_enabled">
                                                            {{ __('Enabled') }}
                                                        </label>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="is_enabled" value="1">
                                                @endif
                                                <div class="custom-control custom-switch">
                                                    <input class="custom-control-input" id="admin_role" name="admin_role" type="checkbox" value="1"
                                                    @if($user->hasRole('admin'))
                                                        checked
                                                    @endif
                                                    >
                                                    <label class="custom-control-label" for="admin_role">
                                                        {{ __('Administrator Permission') }}
                                                    </label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
