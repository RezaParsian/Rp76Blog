<?php

namespace App\Models;

use App\{Http\Helper\CategorizeAble, Http\Helper\CustomModel};
use Illuminate\{Database\Eloquent\Factories\HasFactory, Database\Eloquent\Model, Database\Eloquent\SoftDeletes};

class Role extends Model
{
    use HasFactory, SoftDeletes,CustomModel;

    const NAME = 'name',
        SCOPE = 'scope';

    protected $fillable = [
        self::NAME,
        self::SCOPE,
    ];
}
