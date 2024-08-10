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
        'weight_product_g',
        'width_product_mm',
        'height_product_mm',
        'length_product_mm',
        'weight_package_g',
        'width_package_mm',
        'height_package_mm',
        'length_package_mm',
        'category'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
