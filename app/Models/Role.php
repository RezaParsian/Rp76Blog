<?php

namespace App\Models;

use App\{Http\Helper\CustomModel};
use Illuminate\{Database\Eloquent\Factories\HasFactory, Database\Eloquent\Model, Database\Eloquent\SoftDeletes};

/**
 * @property string $scope
 */
class Role extends Model
{
    use HasFactory, SoftDeletes, CustomModel;

    const NAME = 'name',
        SCOPE = 'scope';

    protected $fillable = [
        self::NAME,
        self::SCOPE,
    ];
}
