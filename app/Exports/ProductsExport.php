<?php

namespace App\Exports;

use App\Helpers\Formatters;
use App\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromQuery, ShouldQueue, WithHeadings, WithMapping, WithColumnFormatting, WithColumnWidths, WithStyles
{
    use Exportable;

    /**
     * @return Builder;
     */
    public function query()
    {
        return Product::query();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Is Enabled',
            'Description',
            'Category',
            'Image Path',
            'Price',
            'Stock',
            'Created At',
            'Updated At'
        ];
    }

    /**
    * @var Product $product
    */
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            Formatters::enabledFormatterString($product->is_enabled),
            $product->description,
            $product->category,
            $product->getGetImageAttribute(),
            $product->price,
            $product->stock,
            Date::dateTimeToExcel($product->created_at),
            Date::dateTimeToExcel($product->updated_at)
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_CURRENCY_COL,
            'I' => NumberFormat::FORMAT_DATE_DATETIME,
            'J' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'B' => 33,
            'C' => 10,
            'D' => 20,
            'E' => 11,
            'F' => 11,
            'G' => 16,
            'I' => 20,
            'J' => 20
        ];
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startColor' => [
                        'argb' => 'FFA0A0A0',
                    ],
                    'endColor' => [
                        'argb' => 'FFFFFFFF',
                    ],
                ],
            ]
        ];
    }
}
