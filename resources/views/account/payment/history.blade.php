@extends('layouts.app')

@section('content')
    <section id="payment-response" class="bg-success">
        <div class="container">
            <div class="row pt-4">
                <div class="col">
                    <h1 class="mb-0 text-white text-center display-4"><i class="fas fa-file-invoice pr-3"></i><b>{{ __($payment->reference) }}</b></h1>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col">
                    <div class="container">
                        <div class="row">
                            <div class="col text-right">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-warning list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ __('Status').":" }}</span>
                                        <span>{{ __($payment->status) }}</span>
                                    </li>
                                    <li class="list-group-item list-group-item-warning list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ __('Message').":" }}</span>
                                        <span>{{ $payment->message }}</span>
                                    </li>
                                    <li class="list-group-item list-group-item-warning list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ __('Date').":" }}</span>
                                        <span>{{ $payment->updated_at->format('d/m/Y') }}</span>
                                    </li>
                                    <li class="list-group-item list-group-item-warning list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ __('Hour').":" }}</span>
                                        <span>{{ $payment->updated_at->format('H:i:s A').' ('.$payment->updated_at->diffForHumans().') ' }}</span>
                                    </li>
                                    <li class="list-group-item list-group-item-warning list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ __('Total').":" }}</span>
                                        <span>{{ App\Helpers\Formatters::priceFormatter($payment->amount) }}</span>
                                    </li>
                                </ul>
                                <ul class="list-group pt-5">
                                    <li class="list-group-item list-group-item-action">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col text-left">
                                                        <b>{{ __('Name') }}</b>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <b>{{ __('Amount') }}</b>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <b>{{ __('Price') }}</b>
                                                    </div>
                                                    <div class="col-3">
                                                        <b>{{ __('Total') }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @foreach(\GuzzleHttp\json_decode($payment->invoice) as $product)
                                        <li class="list-group-item list-group-item-action">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col text-left">
                                                    {{ $product->name.":" }}
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        {{ $product->amount }}
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        {{ App\Helpers\Formatters::priceFormatter($product->price) }}
                                                    </div>
                                                    <div class="col-3">
                                                        {{ App\Helpers\Formatters::priceFormatter($product->amount*$product->price) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-4 pb-4">
                <div class="col">
                    @if($payment->status != 'PENDING' && $payment->status != 'APPROVED')
                        <a class="btn btn-block btn-danger" href="{{ route('payment.retry', ['payment_id' => $payment->id]) }}">{{ __('Retry payment') }}</a>
                    @else
                        @if ($payment->status != 'APPROVED')
                            <a class="btn btn-block btn-primary" href="{{ $payment->url }}">{{ __('Resume payment') }}</a>
                        @endif
                    @endif
                </div>
                <div class="col">
                    <a class="btn btn-block btn-outline-warning" href="{{ route('account', 1) }}">{{ __('Go to shopping history') }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
