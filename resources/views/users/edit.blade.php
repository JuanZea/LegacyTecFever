@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex rounded bg-dark mt-4 p-3 text-white align-items-center">
        <div>
            <a class="btn btn-bookend-alt" href="{{ route('users.show',$user) }}">
                <i class="fas fa-arrow-circle-left fa-2x">
                </i>
            </a>
        </div>
        <div>
            <h1 class="mb-0 ml-3">
                Menú de edición de usuario
            </h1>
        </div>
    </div>
</div>
<div class="row rounded bg-dark my-4 p-3">
    <div class="col">
        <div class="container">
            <div class="row rounded bg-bookend-secondary py-3">
                <div class="col">
                    <form action="{{ route('users.update',$user) }}" method="post">
                        @csrf @method('PATCH')
                        <div class="row">
                            <div class="form-group col-12 col-md-4">
                                <label class="text-md-left" for="name">
                                    Nombre del usuario
                                </label>
                                <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                                </input>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label class="text-md-left" for="email">
                                    Correo electrónico del
                                usuario
                                </label>
                                <input class="form-control" name="email" type="text" value="{{ $user->email }}">
                                </input>
                            </div>
                            <div class="form-group col-12 col-md-4 d-flex flex-column justify-content-end">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="isEnabled" name="isEnabled" type="checkbox"
                                    @if($user->isEnabled)
                                        checked
                                    @endif
                                    >
                                    <label class="custom-control-label" for="isEnabled">
                                        Habilitado
                                    </label>
                                    </input>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="isAdmin" name="isAdmin" type="checkbox"
                                    @if($user->isAdmin)
                                        checked
                                    @endif>
                                        <label class="custom-control-label" for="isAdmin">
                                            Permisos de administrador
                                        </label>
                                    </input>
                                </div>
                            </div>
                        </div>
                        <hr>
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-md-3">
                                    <button class="btn btn-block btn-danger">
                                        Actualizar
                                    </button>
                                </div>
                            </div>
                        </hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>