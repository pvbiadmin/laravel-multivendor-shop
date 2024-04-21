<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    use HasFactory;

    /**
     * Relationship: Product Variant has many Product Variant Options
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productVariantOptions(): HasMany
    {
        return $this->hasMany(ProductVariantOption::class);
    }

    /**
     * Relationship: This Belongs to the Product Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
