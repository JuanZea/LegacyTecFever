@extends('layouts.app')

@section('content')
	<section id="control-panel" class="scene-wall d-flex align-items-center">
        <div class="container">
            <div class="row p-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header text-center">
                            @lang('users.titles.index')
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <a class="text-dark" href="{{ route('users.index') }}"><i class="fas fa-users sel hvr-grow-rotate fa-7x"></i></a>
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
                            @lang('products.titles.index')
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <a class="text-dark" href="{{ route('products.index') }}"><i class="fas fa-boxes sel hvr-grow-rotate fa-7x"></i></a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{ __('Manage TecFever products') }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header text-center">
                            @lang('Reports')
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <a class="text-dark" href="{{ route('reports.summary') }}"><i class="fas fa-chart-line sel hvr-grow-rotate fa-7x"></i></a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{ __('Manage TecFever reports') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
