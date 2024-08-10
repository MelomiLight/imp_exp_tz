<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_code',
        'name',
        'description',
        'price',
        'currency_price',
        'purchase_price',
        'currency_purchase_price',
        'discount'
    ];

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->discount = $model->price != 0
                ? (($model->price - $model->purchase_price) / $model->price) * 100
                : 0;
        });
    }

    public function additional_info(): HasOne
    {
        return $this->hasOne(ProductAdditionalInfo::class);
    }

    public function uploads(): MorphMany
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }
}
