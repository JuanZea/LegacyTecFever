@extends('layouts.app')

@section('content')
<section id="account">
    <form id="information_email_form" action="{{ route('information_email', $user) }}" method="POST">
        @csrf
    </form>
    {{--Main--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 py-3 bg-tec px-0 flex-column d-flex justify-content-around hole">

                <a style="text-decoration: none" href="{{ route('account') }}" class="d-flex align-items-center tab-sidebar tab-sidebar-active">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 d-flex justify-content-center align-items-center">
                                <i class="far fa-address-card text-white"></i>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center">
                                <p class="text-white mb-0 text-center">{{ ucfirst(trans('personal information')) }}</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a style="text-decoration: none" href="{{ route('account.shopping_history') }}" class="d-flex align-items-center tab-sidebar">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 d-flex justify-content-center align-items-center">
                                <i class="fas fa-money-bill-wave text-white"></i>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center">
                                <p class="text-white mb-0 text-center">{{ ucfirst(trans('shopping history')) }}</p>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col py-3 pr-0" style="background-color: #070E1C">
                <section id="profile">
                    {{--Main--}}
                    <div class="container text-white">
                        <div class="row pt-4">
                            <div class="col">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                    @endif
                                <form id="update_form" action="{{ route('users.update', $user) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="row pb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="name" >{{ ucfirst(trans('name')).':' }}</label>
                                                </div>
                                                <div class="col">
                                                    <label for="surname" >{{ ucfirst(trans('surname')).':' }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name',$user->name) }}">
                                                </div>
                                                <div class="col">
                                                    <input id="surname" class="form-control" type="text" name="surname" value="{{ old('surname',$user->surname) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="email" >{{ ucfirst(trans('email')).':' }}</label>
                                                </div>
                                                <div class="col">
                                                    <label for="mobile" >{{ ucfirst(trans('mobile')).':' }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="email" class="form-control" type="text" name="email" value="{{ old('email',$user->email) }}">
                                                </div>
                                                <div class="col">
                                                    <input id="mobile" class="form-control" type="text" name="mobile" value="{{ old('mobile',$user->mobile) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="document_type" >{{ ucfirst(trans('document type')).':' }}</label>
                                                </div>
                                                <div class="col">
                                                    <label for="document" >{{ ucfirst(trans('document')).':' }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <select id="document-type" name="document_type" class="form-control">
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
                                                        </optgroup></select>
                                                </div>
                                                <div class="col">
                                                    <input id="document" class="form-control" type="text" name="document" value="{{ old('document',$user->document) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 pt-4">
                                            <button form="update_form" class="btn btn-block btn-lg btn-outline-danger">{{ ucwords(trans('save changes')) }}</button>
                                            <p class="pt-4">{{ ucfirst(trans('dic.confidential_info')).'.' }}</p>
                                            <button form="information_email_form" class="btn btn-lg btn-outline-warning" >{{ ucfirst(trans('request personal information')) }}</button>
                                        </div>
                                        <div class="col text-right">
                                            <img class="img-fluid" src="{{ asset('images/main/TfLogo.png') }}" alt="@lang('dic.tf_lg')">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--/Main--}}
                </section>
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection

