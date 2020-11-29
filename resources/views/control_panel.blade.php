@extends('layouts.app')

@section('content')
	<section id="control-panel" class="scene-wall d-flex align-items-center">
        <div class="container">
            <div class="row p-5">
                <div class="col col-sm-6">
                    <div class="card">
                        <div class="card-header text-center">
                            {{ __('Users Management') }}
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <i class="fas fa-users fa-7x"></i>
                            </div>
                            <div>
                                <a class="btn btn-dark btn-lg" href="{{ route('users.index') }}">{{ __('Go to users management') }}</a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{ __('Manage TecFever users') }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header text-center">
                            {{ __('Products Management') }}
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <i class="fas fa-boxes fa-7x"></i>
                            </div>
                            <div>
                                <a class="btn btn-dark btn-lg" href="{{ route('products.index') }}">{{ __('Go to products management') }}</a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{ __('Manage TecFever products') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
