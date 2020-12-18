@extends('layouts.app')

@section('content')
    <section id="products-report" class="scene-cobweb-base">
        <div class="container">

            {{-- Header --}}
            <section class="container">
                <div class="row pt-4">
                    <div class="col">
                        <a href="{{ route('control_panel') }}"><img class="img-fluid stamp hvr-grow" src="{{ asset('images/main/back_icon.png') }}" alt="@lang('back icon')"></a>
                    </div>
                    <div class="col text-center">
                        <h1><b>{{ ucfirst(trans('exports')) }}</b></h1>
                    </div>
                    <div class="col"></div>
                </div>
            </section>
            {{-- /Header --}}

            {{-- Nav --}}
            <section class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.summary') }}">{{ ucfirst(trans('summary')) }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('exports.index') }}">{{ ucfirst(trans('exports')) }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">@lang('Charts [Very Soon]')</a>
                    </li>
                </ul>
            </section>
            {{-- /Nav --}}

            <section class="container bg-cloud p-4 mb-4">
                <div class="row">
                    <div class="col">

                        {{-- Introduction --}}
                        <div class="container bg-white pt-2 mb-4">
                            <div class="row d-flex justify-content-center">
                                <div class="col"><p><b>{{ ucfirst(trans('date')).': ' }}</b>{{ now() }}</p></div>
                                <div class="col text-center"><p><b>{{ ucfirst(trans('exports')) }}</b></p></div>
                                <div class="col text-right"><i class="fas fa-receipt"></i></div>
                            </div>
                        </div>
                        {{-- /Introduction --}}

                    </div>
                </div>

                {{-- Table --}}
                @if(count($exports) == 0)

                    {{-- Alert --}}
                    <section class="container mb-5">
                        <div class="row">
                            <div class="col text-center">
                                <div class="alert alert-primary shadow" role="alert">
                                  @lang('dic.var.empty_table', ['model' => trans('exports')])
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <a class="hvr-icon-spin text-dark br-white"><i class="fas fa-10x fa-receipt hvr-icon"></i></a>
                            </div>
                        </div>
                    </section>
                    {{-- /Alert --}}

                @else
                    <table class="table table-warning shadow">
                      <thead>
                        <tr class="text-center">
                          <th scope="col">{{ ucfirst(trans('date')). ' ( D / M / Y )' }}</th>
                          <th scope="col">{{ ucfirst(trans('name')) }}</th>
                          <th scope="col">{{ ucfirst(trans('download')) }}</th>
                          <th scope="col">{{ ucfirst(trans('delete')) }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($exports as $export)
                            <tr class="text-center">
                                <td>{{ $export->date }}</td>
                                <td>{{ $export->name }}</td>
                                <td>
                                    @if ($export->status == 0)
                                        {{ ucfirst(trans('export in progress')).'...' }}
                                    @else
                                        <a class="btn btn-success" href="{{ route('exports.download', $export) }}">@lang('download')</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($export->status == 0)
                                        {{ ucfirst(trans('export in progress')).'...' }}
                                    @else
                                        <form action="{{ route('exports.destroy', $export) }}" method="POST" onclick="return confirm('¿Estas seguro?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger">@lang('delete')</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                @endif
                {{-- /Table --}}

            </div>
        <section>&nbsp;</section>
        </section>
    </section>
@endsection

