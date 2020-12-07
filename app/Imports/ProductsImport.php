<?php

namespace App\Imports;

use App\Helpers\Formatters;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, WithUpserts
{
    use Importable;
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        $product = new Product([
            'id' => $row['id'],
            'name' => $row['name'],
            'is_enabled' => Formatters::enabledFormatterBool($row['is_enabled']),
            'description' => $row['description'],
            'category' => $row['category'],
            'image' => Formatters::imageLink($row['image_path']),
            'price' => $row['price'],
            'stock' => Formatters::NullOrZero($row['stock'])
        ]);

        return $product;
    }

    public function rules(): array
    {
        return [
            'id' => 'bail|required|numeric',
            'name' => 'bail|required|min:3|max:60',
            'description' => 'bail|required|min:10|max:1000',
            'category' => 'bail|required|in:computer,smartphone,accessory',
            'image_path' => 'bail|nullable|string',
            'is_enabled' => 'bail|required',
            'price' => 'bail|required|digits_between:4,9',
            'stock' => 'bail|nullable|digits_between:1,9'
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages(): array
    {
        return [
            'name.required' => trans('products.error_messages.name.required'),
            'name.min' => trans('products.error_messages.name.min'),
            'name.max' => trans('products.error_messages.name.max'),
            'description.required' => trans('products.error_messages.description.required'),
            'description.min' => trans('products.error_messages.description.min'),
            'description.max' => trans('products.error_messages.description.max'),
            'category.required' => trans('products.error_messages.category.required'),
            'category.in' => trans('products.error_messages.category.in'),
            'image_path.string' => trans('products.error_messages.image_path.string'),
            'price.required' => trans('products.error_messages.price.required'),
            'price.digits_between' => trans('products.error_messages.price.digits_between'),
            'stock.digits_between' => trans('products.error_messages.stock.digits_between')
        ];
    }

    /**
     * @return array|string
     */
    public function uniqueBy()
    {
        return 'id';
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
