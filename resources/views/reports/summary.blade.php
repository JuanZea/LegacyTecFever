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
                <a class="nav-link active" href="{{ route('reports.summary') }}">@lang('Summary')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reports.specifics') }}">@lang('Specific reports')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('exports.index') }}">@lang('Exports')</a>
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
                                <p><b>@lang('Reports'): </b></p>
                                <p>@lang('products.reports_messages.intro')</p>
                                <p><b>@lang('The most seen'):</b></p>
                                @if (!$most_viewed_product)
                                    <p>@lang('There is no product to report')</p>
                                @else
                                    <p>@lang('products.reports_messages.most_viewed', ['most_viewed' => $most_viewed_product->name, 'views' => \GuzzleHttp\json_decode($most_viewed_product->stats, true)['views']])</p>
                                @endif
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

