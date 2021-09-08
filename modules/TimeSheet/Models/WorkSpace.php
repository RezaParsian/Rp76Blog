<?php

namespace Modules\TimeSheet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $valid)
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
}
