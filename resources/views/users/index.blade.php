@extends('layouts.app')

@section('content')

    <section class="container-fluid scene-cobweb">

        {{-- Header --}}
        <section class="container">
            <div class="row py-4">
                <div class="col text-center">
                    <a href="{{ route('control_panel') }}"><img class="stamp img-fluid hvr-grow" src="{{ asset('images/main/back_icon.png') }}" alt="@lang('back icon')"></a>
                </div>
                <div class="col text-center align-self-center">
                    <h1><b>{{ ucwords(trans('users.titles.index')) }}</b></h1>
                </div>
                <div class="col"></div>
            </div>
        </section>
        {{-- /Header --}}

        {{-- Table --}}
        <section class="container">
            <div class="row">
                <div class="col-8 offset-2">
                    <table class="table table-striped table-light shadow">
                        <thead>
                            <tr>
                                <th scope="col">
                                    {{ ucfirst(trans('id')) }}
                                </th>
                                <th scope="col">
                                    {{ ucfirst(trans('name')) }}
                                </th>
                                <th scope="col" class="text-center">
                                    {{ ucfirst(trans('status')) }}
                                </th>
                                <th scope="col">
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row" class="align-middle">
                                    {{ $user->id }}
                                </th>
                                <td class="align-middle">
                                    {{ $user->name }}
                                </td>
                                <td class="text-center align-middle">
                                    @if($user->hasRole('admin'))
                                            <span class="rounded-pill p-2 bg-warning">
                                                <i class="fas fa-star">&nbsp;</i>
                                                @lang('administrator')&nbsp;
                                                <i class="fas fa-star"></i>
                                            </span>
                                    @else
                                        @if($user->is_enabled)
                                            <span class="rounded-pill p-2 bg-success text-white">
                                                @lang('enabled')
                                            </span>
                                        @else
                                            <span class="rounded-pill p-2 bg-danger text-white">
                                                @lang('disabled')
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-tec text-center" href="{{ route('users.show', $user) }}">
                                        @lang('show')
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        {{-- /Table --}}

        {{-- Paginate --}}
        <section class="container">
            <div class="row">
                <div class="col">
                    <div class="actions d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </section>
        {{-- /Paginate --}}

    </section>
@endsection
