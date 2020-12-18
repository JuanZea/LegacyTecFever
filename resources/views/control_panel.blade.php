@extends('layouts.app')

@section('content')

    <section class="container-fluid scene-wall">

        {{-- Header --}}
        <section class="container-fluid">
            <div class="row pt-3">
                <div class="col text-center">
                    @if (config('app.locale') == 'en')
                        <img class="img-fluid stamp-lg" src="{{ asset('images/main/control_panel.png') }}" alt="@lang('dic.cp_title')">
                   @else
                        <img class="img-fluid stamp-lg" src="{{ asset('images/main/panel_de_control.png') }}" alt="@lang('dic.cp_title')">
                   @endif
                </div>
            </div>
        </section>
        {{-- /Header --}}

        {{-- Body --}}
        <section class="container">
            <div class="row p-5">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            {{ ucfirst(trans('users.titles.index')) }}
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <a class="text-dark" href="{{ route('users.index') }}"><i class="fas fa-users hvr-grow-rotate fa-7x"></i></a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{ ucfirst(trans('users.sentences.control_panel')) }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            {{ ucfirst(trans('products.titles.index')) }}
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <a class="text-dark" href="{{ route('products.index') }}"><i class="fas fa-boxes hvr-grow-rotate fa-7x"></i></a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{ ucfirst(trans('products.sentences.control_panel')) }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            {{ ucfirst(trans('reports.title.index')) }}
                        </div>
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <a class="text-dark" href="{{ route('reports.summary') }}"><i class="fas fa-chart-line hvr-grow-rotate fa-7x"></i></a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{ ucfirst(trans('reports.sentences.control_panel')) }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /Body --}}

    </section>
@endsection
