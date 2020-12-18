@extends('layouts.app')

@section('content')
<section id="account">
    {{--Main--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 py-3 bg-tec px-0 flex-column d-flex justify-content-around hole">

                <a style="text-decoration: none" href="{{ route('account') }}" class="d-flex align-items-center tab-sidebar">
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

                <a style="text-decoration: none" href="{{ route('account.shopping_history') }}" class="d-flex align-items-center tab-sidebar tab-sidebar-active">
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
                <section id="shopping-history">
                    {{--Main--}}
                    <div class="container text-white">
                        <div class="row pt-4">
                            <div class="col">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <h2 class="text-center">{{ ucfirst(trans('history')) }}</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if($user->hasHistory())
                                                <table class="table table-dark text-center">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            {{ ucfirst(trans('reference')) }}
                                                        </th>
                                                        <th scope="col">
                                                            {{ ucfirst(trans('status')) }}
                                                        </th>
                                                        <th scope="col">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @for($idx = count($user->payments) - 1; $idx >= 0; $idx--)
                                                    @continue($user->payments[$idx]->status == 'PENDING')
                                                    <tr>
                                                        <td>
                                                            {{ $user->payments[$idx]->reference }}
                                                        </td>
                                                        <td>
                                                            <b style="color: {{ App\Helpers\Formatters::stateColor($user->payments[$idx]->status) }}">{{ __($user->payments[$idx]->status) }}</b>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('payment.history', ['payment_id' => $user->payments[$idx]->id]) }}" class="btn btn-block btn-outline-warning" >{{ ucfirst(trans('show')) }}</a>
                                                        </td>
                                                    </tr>
                                                @endfor
                                                </tbody>
                                            </table>
                                            @else
                                                <h1 class="my-3 text-white text-center display-1"><i class="fas fa-heart-broken"></i></h1>
                                                <p class="text-center">{{ucfirst(trans('dic.no_bought')).'!' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <h2 class="text-center">{{ ucfirst(trans('pending payments')) }}</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if(count($user->payments) > 0 && $user->pendingpayment())
                                                <table class="table table-dark">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            {{ ucfirst(trans('reference')) }}
                                                        </th>
                                                        <th scope="col">
                                                            {{ ucfirst(trans('status')) }}
                                                        </th>
                                                        <th scope="col">
                                                            &nbsp;
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->payments as $payment)
                                                        @continue($payment->status != 'PENDING')
                                                        <tr>
                                                            <td>
                                                                {{ $payment->reference }}
                                                            </td>
                                                            <td>
                                                                <b style="color: {{ App\Helpers\Formatters::stateColor($payment->status) }}">{{ trans($payment->status) }}</b>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('payment.history', ['payment_id' => $payment->id]) }}" class="btn btn-block btn-outline-warning" >{{ ucfirst(trans('show')) }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                                <h1 class="my-3 text-white text-center display-1"><i class="fas fa-chess-knight"></i>-<i class="fas fa-check-circle"></i></h1>
                                                <p class="text-center">{{ ucfirst(trans('dic.no_pending')) }}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
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
