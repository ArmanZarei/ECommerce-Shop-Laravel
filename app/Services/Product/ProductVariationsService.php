<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Models\ProductVariation;

class ProductVariationsService
{
    public function updateAndDeleteOldProductVariations(Product $product, array $oldProductVariationsArr)
    {
        $productVariations = $product->variations;
        $productVariationIdsToRemove = array_diff($productVariations->pluck('id')->toArray(), array_keys($oldProductVariationsArr ?? []));
        ProductVariation::destroy($productVariationIdsToRemove);
        if ($oldProductVariationsArr) {
            ProductVariation::whereIn('id', array_keys($oldProductVariationsArr))->get()->each(function ($item, $key) use ($oldProductVariationsArr) {
                $item->update($oldProductVariationsArr[$item->id]);
            });
        }
    }

    public function createNewProductVariations(Product $product, array $newProductVariationsArr)
    {
        if ($newProductVariationsArr) {
            $categoryAttributes = $product->category->attributes;

            if ($variationAttr = $categoryAttributes->where('pivot.is_variation', true)->first()) {
                $product->variations()->createMany(array_map(function ($variation) use ($variationAttr) {
                    return $variation + ['attribute_id' => $variationAttr->id];
                }, $newProductVariationsArr));
            }
        }
    }
}
