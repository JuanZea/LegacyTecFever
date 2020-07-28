@extends('layouts.app')

@section('content')
    <section id="user-show">
        <div class="container">
            <div class="row rounded bg-dark mt-4 p-3 d-flex text-white align-items-center justify-content-between">
                <div>
                    <a class="btn btn-bookend-alt" href="{{ route('users.index',$user) }}"><i class="fas fa-arrow-circle-left fa-2x"></i></a>
                </div>
                <div>
                    <h1 class="my-0"><i class="far fa-user px-2"></i>Información del
                        usuario </h1>
                </div>
                <div>
                    <a class="btn btn-bookend-alt" href="{{ route('users.edit',$user) }}"><i class="fas fa-pencil-alt fa-2x"></i></i></a>
                </div>
            </div>
            <div class="row rounded bg-dark my-4 py-4">
                <div class="col-12 col-sm-6 col-md">
                    <div class="card bg-primary text-white">
                        <div class="card-header d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Nombre</h4>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center text-uppercase">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md">
                    <div class="card bg-primary text-white">
                        <div class="card-header card-header d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Correo Electrónico</h4>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <p>{{ $user->email }}</p>
                            @if ($user->email_verified_at != null)
                                <span class="rounded-pill bg-success p-2">{{ "VERIFICADO" }}</span>
                            @else
                                <span class="rounded-pill bg-danger p-2">{{ "SIN VERIFICAR" }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md">
                    <div class="card text-white
                    @if ($user->isAdmin)
                        bg-warning
                    @else
                        bg-primary
                    @endif">
                        <div class="card-header card-header d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Rango</h4>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            @if ($user->isAdmin)
                                <p>ADMINISTRADOR</p>
                            @else
                                USUARIO COMÚN
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md">
                    <div class="card text-white
                    @if ($user->isEnabled)
                        bg-success
                    @else
                        bg-danger
                    @endif">
                        <div class="card-header card-header d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Estado</h4>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            @if ($user->isEnabled)
                                <p>HABILITADO</p>
                            @else
                                <p>DESHABILITADO</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
