@extends('layouts.app')

@section('content')
<section id="products-report" class="scene-cobweb-base">
    <div class="container">

        {{-- Header --}}
        <div class="s-header row py-4 d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ route('control_panel') }}"><img src="{{ asset('images/main/BackIcon.png') }}" alt="Back icon"></a>
                </div>
                <div>
                    <h1 class="title-tec d-flex align-items-center"><i class="fas fa-chart-line px-2"></i></i>@lang('products.titles.report')</h1>
                </div>
                <div>
                    <a class="hvr-pulse-grow" data-toggle="modal" data-target="#actionsModal"><i class="fas fa-database br-black"></i></a>
                </div>
            </div>
        {{-- /Header --}}

        {{-- Nav --}}
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('reports.summary') }}">@lang('Summary')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('exports.index') }}">@lang('Exports')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">@lang('Charts [Very Soon]')</a>
            </li>
        </ul>
        {{-- /Nav --}}

        <div class="container bg-cloud p-4">
            <div class="row">
                <div class="col">
                    {{-- Introduction --}}
                    <div class="container bg-white pt-2">
                        <div class="row d-flex justify-content-center">
                            <div class="col"><p><b>@lang('Date'): </b>{{ now() }}</p></div>
                            <div class="col text-center"><p><b>@lang('Reports')</b></p></div>
                            <div class="col text-right"><i class="fas fa-receipt"></i></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>@lang('products.reports_messages.intro')</p>
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
                            <label for="name">@lang('Enter the name of the report')</label>
                            <input id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" type="text" placeholder="@lang('Christmas report')">
                            <div id="name" class="invalid-feedback">
                                {{ $errors->has('name') ? $errors->first('name') : '' }}
                            </div>
                        </div>
                        <button class="mt-3">{{ strtoupper(trans('Generate report')) }}</button>
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
                                    <div class="container">
                                        <div class="row">
                                            <div class="col text-center">
                                                <p class="mb-0">@lang('common.empty_table', ['model' => trans('common.fields.reports')])</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2 py-2 bg-cloud">
                                            <div class="col d-flex justify-content-around">
                                                <i class="fas fa-receipt fa-5x"></i>
                                                <i class="fas fa-ban fa-5x text-danger"></i>
                                                <i class="fas fa-receipt fa-5x"></i>
                                                <i class="fas fa-ban fa-5x text-danger"></i>
                                                <i class="fas fa-receipt fa-5x"></i>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Table --}}
                                    <table class="table table-warning">
                                      <thead>
                                        <tr class="text-center">
                                          <th scope="col">@lang('common.fields.id')</th>
                                          <th scope="col">@lang('common.fields.date')</th>
                                          <th scope="col">@lang('common.fields.name')</th>
                                          <th scope="col">@lang('common.actions.download')</th>
                                          <th scope="col">@lang('common.actions.delete')</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($reports as $report)
                                            <tr class="text-center">
                                              <th scope="row">{{ $report->id }}</th>
                                              <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                              <td>{{ $report->name }}</td>
                                              <td><a class="btn btn-outline-dark" href="{{ route('reports.download', ['report' => $report]) }}">@lang('common.actions.download')</a></td>
                                              <td>
                                                  <form action="{{ route('reports.destroy', ['report' => $report]) }}" method="POST">
                                                      @csrf @method('DELETE')
                                                      <button class="btn btn-outline-danger">@lang('common.actions.delete')</button>
                                                  </form></td>
                                            </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                    {{-- /Table --}}
                                @endif
{{--                                <p><b>@lang('The most seen'):</b></p>--}}
{{--                                @if (!$most_viewed_product)--}}
{{--                                    <p>@lang('There is no product to report')</p>--}}
{{--                                @else--}}
{{--                                    <p>@lang('products.reports_messages.most_viewed', ['most_viewed' => $most_viewed_product->name, 'views' => \GuzzleHttp\json_decode($most_viewed_product->stats, true)['views']])</p>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
@endsection

