<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagorize extends Model
{
    use HasFactory;

    const TAG_ID = "tag_id",
        TAGORIZE_ID = "tagorize_id",
        TAGORIZE_TYPE = "tagorize_type";

    protected $fillable = [
        self::TAG_ID,
        self::TAGORIZE_ID,
        self::TAGORIZE_TYPE,
    ];

    public function tagorizeable()
    {
        return $this->morphTo();
    }
}
