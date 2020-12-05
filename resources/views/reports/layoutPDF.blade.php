<!doctype html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="pdf-bg">
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <p><b>@lang('Date'):</b> {{ now()->format('d-m-Y') }}</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col text-center">
            <h1 class="pdf-title">{{ $name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="pdf-text">@lang('reports.pdf.intro')</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 class="pdf-subtitle text-danger">@lang('reports.pdf.most_viewed.title')</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($most_viewed_products[5])
                <p class="pdf-text">@lang('reports.pdf.most_viewed.winner', ['winner' => $most_viewed_products[0]['name'], 'views' => \GuzzleHttp\json_decode($most_viewed_products[0]['stats'], true)['views']])</p>
            @endif
            <p class="pdf-text">@lang('reports.pdf.most_viewed.content')</p>

                <table class="table table-info">
                  <thead>
                    <tr>
                        <th scope="col">@lang('common.fields.id')</th>
                        <th scope="col">@lang('common.fields.name')</th>
                        <th scope="col">@lang('common.fields.views')</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($most_viewed_products as $product)
                        @if ($product === true || $product === false)
                            @continue
                        @else
                            <tr>
                                <th scope="row">{{ $product['id'] }}</th>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ \GuzzleHttp\json_decode($product['stats'], true)['views'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                  </tbody>
                </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 class="pdf-subtitle text-danger">@lang('reports.pdf.best_seller.title')</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($best_sellers[5])
                <p class="pdf-text">@lang('reports.pdf.best_seller.winner', ['winner' => $most_viewed_products[0]['name'], 'sales' => \GuzzleHttp\json_decode($most_viewed_products[0]['stats'], true)['sales']])</p>
            @endif
            <p class="pdf-text">@lang('reports.pdf.best_seller.content')</p>

                <table class="table table-info">
                  <thead>
                    <tr>
                        <th scope="col">@lang('common.fields.id')</th>
                        <th scope="col">@lang('common.fields.name')</th>
                        <th scope="col">@lang('common.fields.sales')</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($best_sellers as $product)
                        @if ($product === true || $product === false)
                            @continue
                        @else
                            <tr>
                                <th scope="row">{{ $product['id'] }}</th>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ \GuzzleHttp\json_decode($product['stats'], true)['sales'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                  </tbody>
                </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 class="pdf-subtitle text-danger">@lang('reports.pdf.most_stock.title')</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($best_sellers[5])
                <p class="pdf-text">@lang('reports.pdf.most_stock.winner', ['winner' => $most_stock[0]['name'], 'stock' => $most_stock[0]['stock']])</p>
            @endif
            <p class="pdf-text">@lang('reports.pdf.most_stock.content')</p>

                <table class="table table-info">
                  <thead>
                    <tr>
                        <th scope="col">@lang('common.fields.id')</th>
                        <th scope="col">@lang('common.fields.name')</th>
                        <th scope="col">@lang('common.fields.stock')</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($most_stock as $product)
                        @if ($product === true || $product === false)
                            @continue
                        @else
                            <tr>
                                <th scope="row">{{ $product['id'] }}</th>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ $product['stock'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                  </tbody>
                </table>
        </div>
    </div>
</div>
<style>
    .pdf-bg {
    background-color: #D4F7D8;
    }
    .pdf-title {
        color: #38762E;
        font-size: 33px;
    }
    .pdf-subtitle {
        font-size: 23px;
    }
    .pdf-text {
        font-size: 16px;
    }
</style>
</body>
</html>

