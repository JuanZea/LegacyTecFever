@extends('layouts.app')

@section('content')
<section id="account">
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
                                <form action="{{ route('users.update', $user) }}" method="POST">
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
                                                    <label for="documentType" >{{ ucfirst(trans('document type')).':' }}</label>
                                                </div>
                                                <div class="col">
                                                    <label for="document" >{{ ucfirst(trans('document')).':' }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <select id="document-type" name="documentType" class="form-control">
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
                                                <div class="col">
                                                    <input id="document" class="form-control" type="text" name="document" value="{{ old('document',$user->document) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 pt-4">
                                            <button class="btn btn-block btn-lg btn-outline-danger">{{ ucwords(trans('save changes')) }}</button>
                                            <p class="pt-4">{{ ucfirst(trans('dic.confidential_info')).'.' }}</p>
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

