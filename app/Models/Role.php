<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'roles';

    protected $fillable = ['Role_Type'];
}
