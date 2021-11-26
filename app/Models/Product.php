<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
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
}
