<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type',
    ];
    /**
     * Get the parent imageable model (user or event).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
