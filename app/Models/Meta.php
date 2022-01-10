<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Meta extends Model
{
    use HasFactory;

    const KEY = 'key',
        VALUE = 'value';

    protected $fillable = [
        self::KEY,
        self::VALUE
    ];

    public function metaable(): MorphTo
    {
        return $this->morphTo();
    }
}
