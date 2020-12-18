@extends('layouts.app')

@section('content')
    <section class="container-fluid scene-cobweb-base">

        {{-- Header --}}
        <section class="container">
            <div class="row pt-4">
                <div class="col">
                    <a href="{{ route('control_panel') }}"><img class="img-fluid stamp hvr-grow" src="{{ asset('images/main/back_icon.png') }}" alt="@lang('back icon')"></a>
                </div>
                <div class="col text-center">
                    <h1><b>{{ ucfirst(trans('reports')) }}</b></h1>
                </div>
                <div class="col"></div>
            </div>
        </section>
        {{-- /Header --}}

        {{-- Nav --}}
        <section class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('reports.summary') }}">{{ ucfirst(trans('summary')) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('exports.index') }}">{{ ucfirst(trans('exports')) }}</a>
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
                    <div class="container bg-white pt-2">
                        <div class="row d-flex justify-content-center">
                            <div class="col"><p><b>{{ ucfirst(trans('date')).': ' }}</b>{{ now() }}</p></div>
                            <div class="col text-center"><p><b>{{ ucfirst(trans('reports')) }}</b></p></div>
                            <div class="col text-right"><i class="fas fa-receipt"></i></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>{{ ucfirst(trans('dic.intro_reports')).'.' }}</p>
                            </div>
                        </div>
                    </div>
                    {{-- /Introduction --}}

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4 offset-4 text-center">
                    <form action="{{ route('reports.generate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ ucfirst(trans('enter the report name')) }}</label>
                            <input id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" type="text" placeholder="{{ ucwords(trans('christmas report')) }}">
                            <div id="name" class="invalid-feedback">
                                {{ $errors->has('name') ? $errors->first('name') : '' }}
                            </div>
                        </div>
                        <button class="mt-3 hvr-grow">{{ strtoupper(trans('generate report')) }}</button>
                    </form>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success mt-3 text-center" role="alert">
                  {{ session()->get('message') }}
                </div>
            @endif
            <div class="row mt-3">
                <div class="col">
                    <div class="container bg-white pt-2">
                        <div class="row">
                            <div class="col">
                                @if (count($reports) == 0)

                                    {{-- Alert --}}
                                    <section class="container mb-5">
                                        <div class="row">
                                            <div class="col text-center">
                                                <div class="alert alert-primary shadow" role="alert">
                                                  @lang('dic.var.empty_table', ['model' => trans('reports')])
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
                                    {{-- Table --}}
                                    <table class="table table-warning">
                                      <thead>
                                        <tr class="text-center">
                                          <th scope="col">{{ ucfirst(trans('id')) }}</th>
                                          <th scope="col">{{ ucfirst(trans('date')) }}</th>
                                          <th scope="col">{{ ucfirst(trans('name')) }}</th>
                                          <th scope="col">{{ ucfirst(trans('download')) }}</th>
                                          <th scope="col">{{ ucfirst(trans('delete')) }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($reports as $report)
                                            <tr class="text-center">
                                              <th scope="row">{{ $report->id }}</th>
                                              <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                              <td>{{ $report->name }}</td>
                                              <td><a class="btn btn-outline-dark" href="{{ route('reports.download', ['report' => $report]) }}">@lang('download')</a></td>
                                              <td>
                                                  <form action="{{ route('reports.destroy', ['report' => $report]) }}" method="POST">
                                                      @csrf @method('DELETE')
                                                      <button class="btn btn-outline-danger">@lang('delete')</button>
                                                  </form></td>
                                            </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                    {{-- /Table --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <sectino>&nbsp;</sectino>
</section>
@endsection

