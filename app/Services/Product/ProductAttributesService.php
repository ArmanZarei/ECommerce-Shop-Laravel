<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductAttributesService
{
    public function syncProductAttributes(Product $product, array $attributes)
    {
        $categoryAttributes = $product->category->attributes;

        $productAttributes = [];
        foreach ($attributes as $attrId => $value)
            if ($categoryAttributes->where('pivot.is_variation', false)->where('id', $attrId)->first())
                $productAttributes[$attrId] = ['value' => $value];
        if ($productAttributes)
            $product->attributes()->sync($productAttributes);
    }
}
