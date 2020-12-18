@extends('layouts.app')

@section('content')
<section id="disabled" class="scene-disabled">
    {{--Main--}}
    <div class="container">
        <div class="s-header row">
            <div class="col-md-6 offset-md-3">
                <div class="card text-center my-5">
                    <div class="card-header text-warning text-uppercase">
                        <b>{{ ucfirst(trans('we are sorry')) }}</b>
                    </div>
                    <div class="card-body">
                        <p>{{ ucfirst(trans('it seems that your account is disabled')) }}</p>
                        <p>{{ ucfirst(trans('contact us to reactivate your account')) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--/Main--}}
</section>
@endsection
