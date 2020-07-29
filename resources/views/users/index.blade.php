@extends('layouts.app')

@section('content')
<?php $idx = 1 ?>
<section id="users-index">
    <div class="container pb-5">
        {{-- Header --}}
        <div class="s-header row py-4">
            <div class="col-1 px-0">
                    <a class="align-self-start" href="{{ route('controlPanel') }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back"></a>
            </div>
            <div class="col-10 px-0 d-flex align-items-center justify-content-center">
                <h1 class="title-tec">
                    {{ __('Users Management') }}
                </h1>
            </div>
        </div>
        {{-- /Header --}}

        {{-- Table --}}
        <div class="s-table row">
            <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">
                            {{ __('Id') }}
                        </th>
                        <th class="text-left" scope="col">
                            {{ __('Name') }}
                        </th>
                        <th scope="col">
                            {{ __('Status') }}
                        </th>
                        <th scope="col">
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">
                            {{ $idx }}
                        </th>
                        <td class="text-left">
                            {{ $user->name }}
                        </td>
                        @if($user->isEnabled)
                        <td>
                            <span class="rounded-pill p-2 bg-success text-white">
                                {{ __('Enabled') }}
                            </span>
                        </td>
                        @else
                        <td>
                            <span class="rounded-pill p-2 bg-danger text-white">
                                {{ __('Disabled') }}
                            </span>
                        </td>
                        @endif
                        <td>
                            <a class="btn btn-tec" href="{{ route('users.show',$user) }}">
                                {{ __('Show') }}
                            </a>
                        </td>
                    </tr>
                    <?php $idx++ ?>
                    @endforeach
                </tbody>
            </table>
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
