<?php

namespace App\Exports;

use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProductsExport implements FromQuery
{
    use Exportable;

    /**
     * @return Builder;
     */
    public function query()
    {
        return Product::query();
    }
}
