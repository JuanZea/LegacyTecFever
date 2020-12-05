<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'products',
            'id' => (String) $this->resource->id,
            'attributes' => [
                'name' => $this->resource->name,
                'is_enabled' => $this->resource->is_enabled,
                'description' => $this->resource->description,
                'category' => $this->resource->category,
                'image' => $this->resource->getImage,
                'price' => $this->resource->price,
                'stock' => $this->resource->stock
            ],
            'links' => [
                'self' => route('api.products.show', $this->resource)
            ]
        ];
    }
}
