@extends('layouts.app')

@section('content')
    <section id="users-edit">
        <div class="container">
            {{-- Header --}}
            <div class="s-header row py-4">
                <div class="col-1 px-0">
                     <a class="align-self-start" href="{{ route('users.show',$user) }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
                </div>
                <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                    <h1 class="title-tec">
                        {{ __('Edit Menu') }}
                    </h1>
                </div>
            </div>
            {{-- /Header --}}
            <div class="row">
                <div class="col">
                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                    @endif
                    <hr>
                    <form action="{{ route('users.update',$user) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-12 col-md-4">
                                <label class="text-md-left" for="name">
                                    {{ __('User name') }}
                                </label>
                                <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                                </input>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label class="text-md-left" for="email">
                                    {{ __('User email') }}
                                </label>
                                <input class="form-control" name="email" type="text" value="{{ $user->email }}">
                                </input>
                            </div>
                            <div class="form-group col-12 col-md-4 d-flex flex-column justify-content-end">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="isEnabled" name="isEnabled" type="checkbox" value="1"
                                    @if($user->isEnabled)
                                        checked
                                    @endif
                                    >
                                    </input>
                                    <label class="custom-control-label" for="isEnabled">
                                        {{ __('Enabled') }}
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="isAdmin" name="isAdmin" type="checkbox" value="1"
                                    @if($user->isAdmin)
                                        checked
                                    @endif
                                    >
                                    </input>
                                    <label class="custom-control-label" for="isAdmin">
                                        {{ __('Administrator Permission') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-md-3">
                                {{-- <input name="isAdmin" type="hidden" value="0"> --}}
                                {{-- <input name="isEnalbed" type="hidden" value="0"> --}}
                                <button class="btn btn-block btn-danger">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection