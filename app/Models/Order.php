<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    use HasFactory;

    protected $connection   = 'mongodb';
    protected $collection   = 'orders';
    protected $fillable     = [
        'User_ID',
        'CartID',
        'items',            // ← add this
        'TotalAmount',
        'Status',
        'ShippingAddress',
        'OrderDate',
        'Delivery_Fee',
    ];

    protected $casts = [
        'items'          => 'array',   // ← cast items to array
        'OrderDate'      => 'datetime',
        'TotalAmount'    => 'float',
        'Delivery_Fee'   => 'float',
    ];
}
