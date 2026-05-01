<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'item_kode',
        'item_name',
        'stock',
        'brand',
        'description',
        'price',
        'image'
    ];
    /**
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $code = $attributes['item_kode'] ?? '';
                $name = $attributes['item_name'] ?? '';
                return "{$code} - {$name}";
            },
        );
    }

    /**
     */
    protected function itemCode(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => strtoupper($value),
        );
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
