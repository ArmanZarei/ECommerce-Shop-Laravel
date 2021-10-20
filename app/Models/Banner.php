<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageUrlAttribute()
    {
        return asset('storage/'.env('BANNER_IMAGES_PATH').$this->image);
    }
}
