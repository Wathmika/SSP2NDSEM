<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $primaryKey = '_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'discounted_price',
        'qty',
        'brand',
        'img_url',
        'category',
        'discount',
    ];
}
