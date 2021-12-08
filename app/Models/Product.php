<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    protected $appends = ['is_available'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')->withPivot(['value', 'is_active'])->withTimestamps();
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function getPrimaryImageUrlAttribute()
    {
        return asset('storage/'.env('PRODUCT_IMAGES_PATH').$this->primary_image);
    }

    public function getAvailableVariationAttribute()
    {
        return $this->variations->where('quantity', '>', 0)->sortBy('price')->first();
    }

    public function getIsAvailableAttribute()
    {
        return $this->availableVariation != null;
    }

    public function scopeSearchName(Builder $query, $s)
    {
        if (trim($s))
            return $query->where('name', 'LIKE', "%".trim($s)."%");
        return $s;
    }

    public function scopeFilterAttributes(Builder $query, $attributes)
    {
        if (!$attributes)
            return;
        $query->whereHas('attributes', function (Builder $query) use ($attributes) {
            $i = 0;
            foreach ($attributes as $attributeId => $attributeValues) {
                $whereStr = $i++ == 0 ? 'where' : 'orWhere';
                $query->$whereStr(function (Builder $query) use ($attributeValues, $attributeId) {
                    $query->where('attribute_id', $attributeId)->where(function (Builder $query) use($attributeValues) {
                        foreach ($attributeValues as $k => $attributeValue) {
                            $whereStr = $k == 0 ? 'where' : 'orWhere';
                            $query->$whereStr('value', $attributeValue);
                        }
                    });
                });
            }
        });
    }

    public function scopeFilterVariations(Builder $query, $variations)
    {
        if (!$variations)
            return;
        $query->whereHas('variations', function (Builder $query) use ($variations) {
            foreach ($variations as $k => $variation) {
                $whereStr = $k == 0 ? 'where' : 'orWhere';
                $query->$whereStr('value', $variation);
            }
        });
    }

    public function scopeOrderByCustom(Builder $query, $orderBy)
    {
        switch (trim(strtolower($orderBy))) {
            case 'latest':
                $query->latest();
                break;
            case 'most_expensive':
                $query->orderByDesc(
                    ProductVariation::select('price')->whereColumn('product_variations.product_id', 'products.id')->orderBy('price')->take(1)
                );
            case 'cheapest':
                $query->orderBy(
                    ProductVariation::select('price')->whereColumn('product_variations.product_id', 'products.id')->orderBy('price', 'desc')->take(1)
                );
        }
    }
}
