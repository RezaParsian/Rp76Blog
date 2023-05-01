<?php

namespace App\Models;

use App\Http\Helper\{CategorizeAble, CustomModel};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\MorphOne, Relations\MorphTo, SoftDeletes};

/**
 * @method static create(array $valid)
 * @method static where(string $PARENT_ID, int $int)
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
}
