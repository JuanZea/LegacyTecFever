@extends('layouts.account')

@section('content-account')
    <?php $id = '' ?>
<section id="shopping-history">
    {{--Main--}}
    <div class="container text-white">
        <div class="row pt-4">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-center">{{ __('History') }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if($user->hasHistory())
                                <table class="table table-dark text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            {{ __('Reference') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('Status') }}
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
                                            <a href="{{ route('payment.history', ['payment_id' => $user->payments[$idx]->id]) }}" class="btn btn-block btn-outline-warning" >{{ __('Show') }}</a>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                            @else
                                <h1 class="my-3 text-white text-center display-1"><i class="fas fa-heart-broken"></i></h1>
                                <p class="text-center">{{ __('You haven\'t bought anything yet, brother disappointment!') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-center">{{ __('Pending payments') }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if(count($user->payments) > 0 && $user->pendingpayment())
                                <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            {{ __('Reference') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('Status') }}
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
                                                <b style="color: {{ App\Helpers\Formatters::stateColor($payment->status) }}">{{ __($payment->status) }}</b>
                                            </td>
                                            <td>
                                                <a href="{{ route('payment.history', ['payment_id' => $payment->id]) }}" class="btn btn-block btn-outline-warning" >{{ __('Show') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h1 class="my-3 text-white text-center display-1"><i class="fas fa-chess-knight"></i>-<i class="fas fa-check-circle"></i></h1>
                                <p class="text-center">{{ __('You have no pending payments, wonderful move') }}</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
    {{--Modal--}}
{{--    <div class="modal fade" id="payment-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--      <div class="modal-dialog modal-dialog-centered modal-lg">--}}
{{--        <div class="modal-content modal-custom">--}}
{{--          <div class="modal-header">--}}
{{--              <div class="col-4 offset-4"><h3 class="modal-title text-white text-center" id="exampleModalLabel"><b>{{ $payment->reference }}</b></h3></div>--}}
{{--              <div class="col"><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">--}}
{{--              <span aria-hidden="true"><i class="far fa-times-circle fa-2x"></i></span>--}}
{{--            </button></div>--}}
{{--          </div>--}}
{{--          <div class="modal-body text-white">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <p><b>{{ __('Status').': '}}</b><span style="color: {{ App\Helpers\Formatters::stateColor($payment->status) }}">{{ __($payment->status) }}</span></p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <p><b>{{ __('Payer').': ' }}</b><span>{{ $user->name.' '.$user->surname }}</span></p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="modal-footer">--}}
{{--            <button type="button" class="btn btn-block btn-outline-warning">{{ __('Retry payment') }}</button>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
    {{--/Modal--}}

@endsection
