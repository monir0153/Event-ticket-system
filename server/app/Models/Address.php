<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'country',
        'district',
        'thana',
        'word_no',
        'union_number'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
