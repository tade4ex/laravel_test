<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primaryKey = 'sku';

    protected $keyType = 'string';
    protected $fillable = [
        'sku',
        'description',
        'photo',
        'size',
        'updated_at',
    ];

    public $timestamps = false;

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ProductTag::class, 'product_tag');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(ProductStock::class);
    }
}
