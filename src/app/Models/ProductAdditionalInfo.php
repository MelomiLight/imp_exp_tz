<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size',
        'colour',
        'brand',
        'structure',
        'amount_package',
        'seo_title',
        'seo_h1',
        'seo_description',
        'weight_product',
        'width_product',
        'height_product',
        'length_product',
        'weight_package',
        'width_package',
        'height_package',
        'length_package',
        'category'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
