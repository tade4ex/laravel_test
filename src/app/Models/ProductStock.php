<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primaryKey = 'product_sku';

    protected $keyType = 'string';
    protected $fillable = [
        'product_sku',
        'stock',
        'city',
    ];

    public $timestamps = false;

}
