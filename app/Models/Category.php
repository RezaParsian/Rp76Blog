<?php

namespace App\Models;

use App\Http\Helper\{CustomModel};
use Illuminate\Database\Eloquent\{Collection, Factories\HasFactory, Model, Relations\HasMany, Relations\MorphOne, Relations\MorphTo, SoftDeletes};

/**
 * @method static create(array $valid)
 * @method static where(string $PARENT_ID, int $int)
 * @method static withCount(string $string)
 * @property int $articles_count
 * @property Collection $children
 * @property string $title
 * @property string $slug
 */
class Category extends Model
{
    use HasFactory,SoftDeletes,CustomModel;

    const PARENT_ID = "parent_id",
        TITLE = "title",
        SLUG = "slug";

    protected $fillable = [
        self::PARENT_ID,
        self::TITLE,
        self::SLUG
    ];

    protected $withCount = [
        'articles'
    ];

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, self::PARENT_ID);
    }
}
