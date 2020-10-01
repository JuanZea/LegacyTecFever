@extends('layouts.app')

@section('content')
<section id="disabled">
    {{--Main--}}
    <div class="container">
        <div class="s-header row">
            <div class="col-md-6 offset-md-3">
                <div class="card text-center my-5">
                    <div class="card-header text-warning text-uppercase">
                        <b>{{ __('Your shopping cart is empty') }}</b>
                    </div>
                    <div class="card-body">
                        <p>{{ __('Go to the store and buy products!') }}</p>
                        <p>{{ __('Offers are for a limited time') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection
