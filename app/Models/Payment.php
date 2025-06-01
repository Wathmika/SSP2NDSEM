<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Payment extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'payments';

    protected $fillable = [
        'Order_ID',
        'PaymentDate',
        'BillingAddress',
        'PaymentMethod',
        'Status'
    ];
}
