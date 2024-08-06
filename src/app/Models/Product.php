<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'external_code',
        'name',
        'description',
        'price',
        'discount'
    ];

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function additional_info(): HasOne
    {
        return $this->hasOne(ProductAdditionalInfo::class);
    }

    public function images(): HasOne
    {
        return $this->hasOne(ProductImage::class);
    }
}
