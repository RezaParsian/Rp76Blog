<?php

namespace App\Models;

use App\Http\Helper\CustomModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use HasFactory, SoftDeletes, CustomModel;

    const USER_ID = "user_id",
        SECTION = "section",
        KEY = "key",
        VALUE = "value";

    protected $fillable = [
        self::USER_ID,
        self::SECTION,
        self::KEY,
        self::VALUE,
    ];
}
