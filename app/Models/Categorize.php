<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Categorize extends Model
{
    use HasFactory;

    const
        CATEGORY_ID = "category_id",
        CATEGORIZEABLE_ID = "categorizeable_id",
        CATEGORIZEABLE_TYPE = "categorizeable_type";

    protected $fillable = [
        self::CATEGORY_ID,
        self::CATEGORIZEABLE_ID,
        self::CATEGORIZEABLE_TYPE,
    ];

    /**
     * @return MorphTo
     */
    public function categorizeable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
