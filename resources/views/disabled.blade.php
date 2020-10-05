@extends('layouts.app')

@section('content')
<section id="disabled">
    {{--Main--}}
    <div class="container">
        <div class="s-header row">
            <div class="col-md-6 offset-md-3">
                <div class="card text-center my-5">
                    <div class="card-header text-warning text-uppercase">
                        <b>{{ __('We are sorry') }}</b>
                    </div>
                    <div class="card-body">
                        <p>{{ __('It seems that your account is disabled') }}</p>
                        <p>{{ __('Contact us to reactivate your account') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection
