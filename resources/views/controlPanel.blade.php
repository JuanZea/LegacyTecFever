@extends('layouts.app')

@section('content')
	<section id="dashboard">
        <div class="container">
            <div class="row p-5">
                <div class="col col-sm-6">
                    <div class="card">
                        <div class="card-header text-center">
                            Gestión De Usuarios
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-2">
                                <i class="fas fa-users fa-7x"></i>
                            </div>
                            <div>
                                <a class="btn btn-dark" href="{{ route('users.index') }}">Ir a gestión de usuarios</a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            Gestione los usuarios registrados en TecFever
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header text-center">
                            Gestión De Productos
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-2">
                                <i class="fas fa-boxes fa-7x"></i>
                            </div>
                            <div>
                                <a class="btn btn-dark" href="{{ route('products.index') }}">Ir a gestión de productos</a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            Gestione los productos de la tienda TecFever
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection