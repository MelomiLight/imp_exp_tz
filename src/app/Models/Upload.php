<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'uploads';

    protected $fillable = [
        'uploadable_id',
        'uploadable_type',
        'disk',
        'name',
        'path',
        'size',
        'hash',
        'upload_type'
    ];

    /**
     * @return MorphTo
     */
    public function uploadable(): MorphTo
    {
        return $this->morphTo();
    }
}
