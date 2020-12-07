<?php

namespace App\Actions\Products;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class StoreProductAction
{

    public function __construct()
    {

    }

    /**
     * @param array $request
     * @return Product|Model
     */
    public function execute(array $request)
    {
        $request = $this->saveImage($request);

        return Product::create($request);
    }

    /**
     * @param array $request
     * @return array
     */
    public function saveImage(array $request): array
    {
        $has_image_path = isset($request['image_path']);
        $has_image = isset($request['image']);

        if ($has_image_path) {
            if($has_image) {
                unset($request['image']);
            }
            $request = array_merge($request,['image' => $request['image_path']]);
            unset($request['image_path']);
        } else {
            if($has_image){
                $imagePath = $request['image']->store('images/products', 'public');
                unset($request['image']);
                $request = array_merge($request,['image' => $imagePath]);
            }
        }

        return $request;
    }

}
