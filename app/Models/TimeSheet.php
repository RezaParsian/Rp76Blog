<?php

namespace App\Models;

use App\Http\Helper\CustomModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $valid)
 * @property int $work_time
 * @property string $created_at_p
 * @property int $price
 * @property int user_id
 * @property string $description
 */
class TimeSheet extends Model
{
    use HasFactory, SoftDeletes, CustomModel;

    const USER_ID = "user_id",
        WORK_SPACE_ID = "work_space_id",
        WORK_TIME = "work_time",
        PRICE = "price",
        DESCRIPTION = "description";

    protected $fillable = [
        self::USER_ID,
        self::WORK_SPACE_ID,
        self::WORK_TIME,
        self::PRICE,
        self::DESCRIPTION,
    ];
}
