<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const GATEWAY_ZARINPAL = 'ZARINPAL';
    const GATEWAY_PAY = 'PAY';
    const ALL_GATEWAYS = [
        self::GATEWAY_ZARINPAL,
        self::GATEWAY_PAY,
    ];

    const STATUS_SUCCESSFUL = 'SUCCESSFUL';
    const STATUS_UNSUCCESSFUL = 'UNSUCCESSFUL';
    const ALL_STATUSES = [
        self::STATUS_SUCCESSFUL,
        self::STATUS_UNSUCCESSFUL,
    ];
}
