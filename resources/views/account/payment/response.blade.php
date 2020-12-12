@extends('layouts.app')

@section('content')
    <section id="payment-response" class="bg-success">
        <div class="container">
            <div class="row pt-4">
                <div class="col">
                    <h1 class="mb-0 text-white text-center display-4"><b>{{ ucfirst(trans('the process was successful')) }}</b></h1>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col">
                    <h1 class="mb-0 text-white text-center display-1"><i class="far fa-check-circle"></i></h1>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col">
                    <div class="container">
                        <div class="row">
                            <div class="col text-right d-flex align-items-center">
                                <ul class="list-group" style="width: 100%">
                                    <li class="list-group-item list-group-item-warning list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ ucfirst(trans('status')).":" }}</span>
                                        <span>@lang($payment->status)</span>
                                    </li>
                                    <li class="list-group-item list-group-item-warning list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ ucfirst(trans('total')).":" }}</span>
                                        <span>{{ App\Helpers\Formatters::priceFormatter($payment->amount) }}</span>
                                    </li>
                                    <li class="list-group-item list-group-item-warning list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ ucfirst(trans('reference')).":" }}</span>
                                        <span>{{ $payment->reference }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('images/main/PlacetoPayLogo.png') }}" alt="@lang('dic.pp2.lg')">
                            </div>
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('images/main/TfLogo.png') }}" alt="@lang('dic.tf_lg')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-4 pb-4">
                <div class="col">
                    <a class="btn btn-block btn-outline-light" href="{{ route('home') }}">{{ ucfirst(trans('back to home')) }}</a>
                </div>
                <div class="col">
                    <a class="btn btn-block btn-outline-warning" href="{{ route('account.shopping_history') }}">{{ ucfirst(trans('go to shopping history')) }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
