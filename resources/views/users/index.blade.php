@extends('layouts.app')

@section('content')
<?php $idx = 1 ?>
<section id="UsersManagement">
    <div class="container pb-5">
        <div class="row py-4">
            <div class="col-1 px-0">
                    <a class="btn btn-dark align-self-start" href="{{ route('controlPanel') }}"><img style="height: 50px;" src="{{ asset('image/main/BackIcon.png') }}" alt="Back"></a>
            </div>
            <div class="col-10 px-0">
                <h1 class="text-center">
                    Gestión de usuarios
                </h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" scope="col" style="background: #FFF159">
                            id
                        </th>
                        <th class="text-center" scope="col" style="background: #FFF159">
                            Nombre
                        </th>
                        <th class="text-center" scope="col" style="background: #FFF159">
                            Estado
                        </th>
                        <th class="text-center" scope="col" style="background: #FFF159">
                            Mostrar
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th class="text-center" scope="row" style="vertical-align: middle; background: #FFF159">
                            {{ $idx }}
                        </th>
                        <td class="text-center" style="vertical-align: middle">
                            {{ $user->name }}
                        </td>
                        @if($user->isEnabled)
                        <td class="text-center" style="vertical-align: middle">
                            <span class="rounded-pill p-2 bg-success text-white">
                                Habilitado
                            </span>
                        </td>
                        @else
                        <td class="text-center" style="vertical-align: middle">
                            <span class="rounded-pill p-2 bg-danger text-white">
                                Deshabilitado
                            </span>
                        </td>
                        @endif
                        <td class="text-center" style="vertical-align: middle">
                            <a class="btn btn-dark" href="{{ route('users.show',$user) }}">
                                Mostrar
                            </a>
                        </td>
                    </tr>
                    <?php $idx++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
            <div class="actions d-flex justify-content-center">
                {{ $users->links() }}
            </div>
    </div>
</section>
@endsection
