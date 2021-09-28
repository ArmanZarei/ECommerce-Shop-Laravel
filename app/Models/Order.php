<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_PAYMENT = 'PAYMENT';
    const STATUS_COMPLETED = 'COMPLETED';
    const ALL_STATUSES = [
        self::STATUS_PAYMENT,
        self::STATUS_COMPLETED,
    ];
}
