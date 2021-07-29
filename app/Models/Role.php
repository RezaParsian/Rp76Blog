<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    const NAME = 'name',
        SCOPE = 'scope';

    protected $fillable = [
        self::NAME,
        self::SCOPE,
    ];
}
