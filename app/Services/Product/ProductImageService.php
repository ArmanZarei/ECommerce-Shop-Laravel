<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductImageService
{
    public function createImagesFromUploadedFiles(Product $product, array $images)
    {
        $productImagesArr = array_map(function (UploadedFile $image) use ($product) {
            $imagePath = $image->store('public/'.env('PRODUCT_IMAGES_PATH'));

            return [
                'product_id' => $product->id,
                'image' => basename($imagePath),
            ];
        }, $images);
        $productImages = $productImagesArr ? $product->images()->createMany($productImagesArr) : [];

        return $productImages;
    }

    public function updateOldImages(Product $product, array $newIdsArr)
    {
        $diff = array_diff($product->images->pluck('id')->toArray(), $newIdsArr);
        foreach ($product->images->whereIn('id', $diff) as $productImage)
            Storage::delete('public/'.env('PRODUCT_IMAGES_PATH').$productImage->image);
        if ($diff)
            ProductImage::destroy($diff);
    }
}
