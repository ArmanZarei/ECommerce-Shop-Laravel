<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function values()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')->select(['attribute_id', 'value'])->distinct();
    }

    public function variationValues()
    {
        return $this->hasMany(ProductVariation::class)->select(['attribute_id', 'value'])->distinct();
    }
}
