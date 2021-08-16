<?php

namespace App\Models;

use App\Http\Helper\{CategorizeAble, CustomModel};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\MorphOne, Relations\MorphTo, SoftDeletes};

/**
 * @method static create(array $valid)
 */
class Category extends Model
{
    use HasFactory,SoftDeletes,CustomModel,CategorizeAble;

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
}
