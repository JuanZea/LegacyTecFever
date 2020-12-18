@extends('layouts.app')

@section('content')
<section id="verify">
    <div class="container d-flex align-items-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card hvr-ripple-out">
                    <div class="card-header bg-dark text-center text-warning"><b>{{ ucwords(trans('verify your email address')) }}</b></div>

                    <div class="card-body bg-warning">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ ucfirst(trans('a fresh verification link has been sent to your email address')).'.' }}
                            </div>
                        @endif

                        {{ ucfirst(trans('before proceeding, please check your email for a verification link')).'.' }}
                        {{ ucfirst(trans('if you did not receive the email')).',' }}
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark">{{ ucfirst(trans('click here to request another')) }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
