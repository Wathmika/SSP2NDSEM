<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Cart extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'carts';

    protected $fillable = [
        'User_ID',
        'CreatedAt',
        'UpdatedAt',
        'items'
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
