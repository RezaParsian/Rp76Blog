<?php

namespace App\Models;

use App\Http\Helper\CustomModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $valid)
 */
class Category extends Model
{
    use HasFactory,SoftDeletes,CustomModel;

    const PARENT_ID = "parent_id",
        TITLE = "title",
        SLUG = "slug",
        TYPE = "type";

    protected $fillable = [
        self::PARENT_ID,
        self::TITLE,
        self::SLUG,
        self::TYPE,
    ];

    /**
     * @return MorphOne
     */
    public function categorize(): MorphOne
    {
        return $this->morphOne(Categorize::class,"categorizeable");
    }
}
