@extends('layouts.app')

@section('content')
<section id="users-index" class="scene-cobweb">
    <div class="container pb-5">

        {{-- Header --}}
        <div class="s-header row py-4">
            <div class="col-1 px-0">
                    <a class="align-self-start" href="{{ route('control_panel') }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
            </div>
            <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                <h1 class="title-tec">
                    @lang('users.titles.index')
                </h1>
            </div>
        </div>
        {{-- /Header --}}

        {{-- Table --}}
        <div class="row">
            <div class="col-8 offset-2">
                <table class="table table-striped table-light">
                    <thead>
                        <tr>
                            <th scope="col">
                                @lang('common.fields.id')
                            </th>
                            <th scope="col">
                                @lang('common.fields.name')
                            </th>
                            <th scope="col" class="text-center">
                                @lang('common.fields.status')
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
                                            @lang('Enabled')
                                        </span>
                                    @else
                                        <span class="rounded-pill p-2 bg-danger text-white">
                                            @lang('Disabled')
                                        </span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-tec text-center" href="{{ route('users.show', $user) }}">
                                    @lang('Show')
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- /Table --}}

        {{-- Paginate --}}
        <div class="actions d-flex justify-content-center">
            {{ $users->links() }}
        </div>
        {{-- /Paginate --}}

    </div>
</section>
@endsection
