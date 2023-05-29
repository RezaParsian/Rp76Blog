<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $valid)
 * @method static find(mixed $WORK_SPACE_ID)
 * @method static where(...$data)
 * @property integer user_id
 */
class WorkSpace extends Model
{
    use HasFactory, SoftDeletes;

    const USER_ID = "user_id",
        TITLE = "title",
        PRICE="price";

    protected $fillable = [
        self::USER_ID,
        self::TITLE,
        self::PRICE,
    ];

    /**
     * @return HasMany
     */
    public function timeSheet(): HasMany
    {
        return $this->hasMany(TimeSheet::class);
    }
}
