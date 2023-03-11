<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public $timestamps = false;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany(ProductStock::class, 'product_tag', relatedPivotKey: 'product_sku');
    }
}
