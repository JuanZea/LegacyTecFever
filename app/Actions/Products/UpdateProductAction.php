<?php


namespace App\Actions\Products;


use App\Product;
use Illuminate\Support\Facades\Storage;

class UpdateProductAction
{

    public function __construct()
    {

    }

    /**
     * @param array $request
     * @param Product $product
     */
    public function execute(array $request, Product $product)
    {
        $request = $this->refreshImage($request, $product, new StoreProductAction());
        $request = $this->toEnableOrDisable($request);

        $product->update($request);
    }

    /**
     * @param array $request
     * @param Product $product
     * @param StoreProductAction $storeProductAction
     * @return array
     */
    private function refreshImage(array $request, Product $product, StoreProductAction $storeProductAction) : array
    {
        if (!isset($request['delete'])) {
            $request = $storeProductAction->saveImage($request);
        } else {
            $request['image'] = null;
            Storage::disk('public')->delete($product->image);
        }
        return $request;
    }

    /**
     * @param $request
     * @return array
     */
    private function toEnableOrDisable($request) : array
    {
        if (isset($request['is_enabled'])) {
            unset($request['is_enabled']);
            $request = array_merge($request,['is_enabled' => true]);
        } else {
            $request = array_merge($request,['is_enabled' => false]);
        }
        return $request;
    }

}
