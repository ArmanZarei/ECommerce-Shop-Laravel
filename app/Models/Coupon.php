<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    const TYPE_AMOUNT = 'AMOUNT';
    const TYPE_PERCENTAGE = 'PERCENTAGE';
    const ALL_TYPES = [
        self::TYPE_AMOUNT,
        self::TYPE_PERCENTAGE,
    ];
}
