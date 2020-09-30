@extends('layouts.app')

@section('content')
<section id="profile">
    {{--Main--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8" status-bar style="background-color: red"><a class="btn btn-primary" href="{{ route('payment') }}">Buy</a></div>
            <div class="col">
                <a class="btn btn-danger" href="{{ route('payment',Auth::user()->shoppingCart) }}">{{ __('Pay') }}</a>
{{--                <form action="{{ route('payment') }}" method="POST">--}}
{{--                    <input type="hidden" value="hola juan">--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection
