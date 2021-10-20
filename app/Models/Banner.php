<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageUrlAttribute(): string
    {
        return asset('storage/'.env('BANNER_IMAGES_PATH').$this->image);
    }

    public function deleteImageFile(): bool
    {
        return Storage::delete('public/'.env('BANNER_IMAGES_PATH').$this->image);
    }
}
