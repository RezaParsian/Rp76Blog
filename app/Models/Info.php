<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    const KEY="key",VALUE="value";

    protected $fillable = [
        self::KEY,
        self::VALUE,
    ];

    protected $casts=[
        self::VALUE => 'array'
    ];

    public function userInfo()
    {
        return $this->belongsToMany(User::class);
    }
}
