@extends('layouts.app')

@section('content')

    <section class="container-fluid scene-wall">

            {{-- Header --}}
            <section class="container">
                <div class="row py-4">
                    <div class="col-2 text-center">
                        <a href="{{ route('users.index') }}"><img class="img-fluid stamp hvr-grow" src="{{ asset('images/main/back_icon.png') }}" alt="@lang('back icon')"></a>
                    </div>
                    <div class="col text-center">
                        <h1><b>{{ ucwords(trans('users.titles.show')) }}</b></h1>
                    </div>
                    <div class="col-2 text-center">
                        <a href="{{ route('users.edit',$user) }}"><i class="text-dark fas fa-pencil-alt fa-2x hvr-grow"></i></a>
                    </div>
                </div>
            </section>
            {{-- /Header --}}

            {{-- Alert --}}
            @if (session()->has('message'))
                <section class="container my-4">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-success text-center shadow m-0" role="alert">
                                {{ ucfirst(trans('users.messages.updated')) }}
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            {{-- /Alert --}}

            {{-- User_info--}}
            <section class="container pb-4">
                <div class="row justify-content-center">
                    <div class="col-6 headband-yellow rounded mx-4 p-4">
                        <div class="row mb-2">
                            <div class="col text-center">
                                <h2><b>{{ ucwords(trans('personal information')) }}</b></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span><b>{{ ucfirst(trans('name')).':' }}</b></span>
                            </div>
                            <div class="col">
                                <span>{{ $user->name }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span><b>{{ ucfirst(trans('surname')).':' }}</b></span>
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
                                <span><b>{{ ucfirst(trans('document type')).':' }}</b></span>
                            </div>
                            <div class="col">
                                @if ($user->document_type != null)
                                    <span>{{ $user->document_type }}</span>
                                @else
                                    <span>---</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span><b>{{ ucfirst(trans('document')).':' }}</b></span>
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
                                <span><b>{{ ucfirst(trans('mobile')).':' }}</b></span>
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
                                <span><b>{{ ucfirst(trans('email')).':' }}</b></span>
                            </div>
                            <div class="col">
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span><b>{{ ucfirst(trans('dic.reg_tf')).':' }}</b></span>
                            </div>
                            <div class="col">
                                <span>{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 headband-yellow rounded mx-4 p-4">
                        <div class="row">
                            <div class="col text-center">
                                <h2><b>{{ ucfirst(trans('roles')) }}</b></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                @foreach($roles as $rol)
                                    <p>{{ ucfirst(trans($rol)) }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <h2><b>{{ ucfirst(trans('status')) }}</b></h2>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col text-center">
                                <span class="rounded-pill text-white {{ $user->is_enabled == 1? 'bg-success' : 'bg-danger' }} p-2">{{ $user->is_enabled == 1? ucfirst(trans('enabled')) : ucfirst(trans('disabled')) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- /User_info--}}

    </section>
@endsection
