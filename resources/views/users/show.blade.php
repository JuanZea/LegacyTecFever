@extends('layouts.app')

@section('content')
    <section id="users-show" class="scene-wall">
        <div class="container">

            {{-- Header --}}
            <div class="s-header row py-4 d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ route('users.index') }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
                </div>
                <div>
                    <h1 class="title-tec"><i class="far fa-user px-2"></i>@lang('users.titles.show')</h1>
                </div>
                <div>
                    <a href="{{ route('users.edit',$user) }}"><i class="fas fa-pencil-alt"></i></a>
                </div>
            </div>
            {{-- /Header --}}

            {{-- UserInfo--}}
            <div class="row my-5">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6 headband-yellow rounded mx-4 p-4">
                            <div class="row mb-2">
                                <div class="col text-center">
                                    <h2><b>@lang('Personal information')</b></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span><b>@lang('Name'):</b></span>
                                </div>
                                <div class="col">
                                    <span>{{ $user->name }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span><b>@lang('Surname'):</b></span>
                                </div>
                                <div class="col">
                                    @if ($user->surname != null)
                                        <span>{{ $user->surname }}</span>
                                    @else
                                        <span>---</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span><b>@lang('Document type'):</b></span>
                                </div>
                                <div class="col">
                                    @if ($user->documentType != null)
                                        <span>{{ $user->documentType }}</span>
                                    @else
                                        <span>---</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span><b>@lang('Document'):</b></span>
                                </div>
                                <div class="col">
                                    @if ($user->document != null)
                                        <span>{{ $user->document }}</span>
                                    @else
                                        <span>---</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span><b>@lang('Mobile'):</b></span>
                                </div>
                                <div class="col">
                                    @if ($user->mobile != null)
                                        <span>{{ $user->mobile }}</span>
                                    @else
                                        <span>---</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span><b>@lang('Email'):</b></span>
                                </div>
                                <div class="col">
                                    <span>{{ $user->email }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span><b>@lang('Registered in TecFever'):</b></span>
                                </div>
                                <div class="col">
                                    <span>{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 headband-yellow rounded mx-4 p-4">
                            <div class="row">
                                <div class="col text-center">
                                    <h2><b>@lang('Roles')</b></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <ul>
                                        @foreach($roles as $rol)
                                            <li>
                                                @lang($rol)
                                            </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <h2><b>@lang('Status')</b></h2>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col text-center">
                                    <span class="rounded-pill text-white {{ $user->is_enabled == 1? 'bg-success' : 'bg-danger' }} p-2">{{ $user->is_enabled == 1? trans('Enabled') : trans('Disabled') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /UserInfo--}}
        </div>
    </section>
@endsection
