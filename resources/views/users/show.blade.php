@extends('layouts.app')

@section('content')
    <section id="users-show">
        <div class="container">
            {{-- Header --}}
            <div class="s-header row py-4 d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ route('users.index') }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
                </div>
                <div>
                    <h1 class="title-tec"><i class="far fa-user px-2"></i>{{ __('User Information') }}</h1>
                </div>
                <div>
                    <a href="{{ route('users.edit',$user) }}"><i class="fas fa-pencil-alt"></i></a>
                </div>
            </div>
            {{-- /Header --}}

            {{-- UserInfo--}}
            <div class="s-userInfo row my-5">
                <div class="col-12 col-sm-6 col-md">
                    <div class="card bg-primary text-white">
                        <div class="card-header d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">{{ __('Name') }}</h4>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center text-uppercase">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md">
                    <div class="card bg-primary text-white">
                        <div class="card-header card-header d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">{{ __('Email') }}</h4>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <p>{{ $user->email }}</p>
                            @if ($user->email_verified_at != null)
                                <span class="rounded-pill bg-success p-2">{{ __('Verified') }}</span>
                            @else
                                <span class="rounded-pill bg-danger p-2">{{ __('Unverified') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md">
                    <div class="card text-white
                    @if ($user->isAdmin)
                        bg-warning
                    @else
                        bg-primary
                    @endif">
                        <div class="card-header card-header d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">{{ __('Rank') }}</h4>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            @if ($user->isAdmin)
                                <p>{{ __('Administator') }}</p>
                            @else
                                {{ __('Common User') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md">
                    <div class="card text-white
                    @if ($user->isEnabled)
                        bg-success
                    @else
                        bg-danger
                    @endif">
                        <div class="card-header card-header d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">{{ __('Status') }}</h4>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            @if ($user->isEnabled)
                                <p>{{ __('Enabled') }}</p>
                            @else
                                <p>{{ __('Disabled') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- /UserInfo--}}
        </div>
    </section>
@endsection