@extends('layouts.app')

@section('content')
<section id="products-report" class="scene-cobweb">
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
                <a class="nav-link" href="{{ route('reports.summary') }}">@lang('Summary')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reports.specifics') }}">@lang('Specific reports')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('exports.index') }}">@lang('Exports')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">@lang('Charts [Very Soon]')</a>
            </li>
        </ul>
        {{-- /Nav --}}

        {{-- Introduction --}}
        <div class="container bg-cloud p-4">
            <div class="row">
                <div class="col">
                    <div class="container bg-white pt-2">
                        <div class="row">
                            <div class="col">
                                <p><b>@lang('Date'): </b>{{ now() }}</p>

                                {{-- Table --}}
                                @if(count($exports) == 0)
                                    <p><b>@lang('Exports'): </b></p>
                                    <p>@lang('Looks like you haven\'t exported yet.')</p>
                                @else
                                    <table class="table table-dark">
                                      <thead>
                                        <tr class="text-center">
                                          <th scope="col">@lang('Date'){{ ' ( D / M / Y )' }}</th>
                                          <th scope="col">@lang('common.fields.name')</th>
                                          <th scope="col">@lang('common.actions.download')</th>
                                          <th scope="col">@lang('common.actions.delete')</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($exports as $export)
                                            <tr class="text-center">
                                              <td>{{ $export->date }}</td>
                                              <td>{{ $export->name }}</td>
                                              <td>
                                                  @if ($export->status == 0)
                                                     @lang('Export in progress')...
                                                  @else
                                                    <a class="btn btn-success" href="{{ route('exports.download', $export) }}">@lang('common.actions.download')</a>
                                                  @endif
                                              </td>
                                                <td>
                                                  @if ($export->status == 0)
                                                     @lang('Export in progress')...
                                                  @else
                                                    <form action="{{ route('exports.destroy', $export) }}" method="POST" onclick="return confirm('¿Estas seguro?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-danger">@lang('common.actions.delete')</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- /Introduction --}}

    </div>
</section>
@endsection

