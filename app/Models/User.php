<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable /*implements MustVerifyEmail*/
{
    use HasFactory, Notifiable, SoftDeletes;

    const ROLE_ID = "role_id",
        NAME = "name",
        EMAIL = "email",
        EMAIL_VERIFIED_AT = "email_verified_at",
        PASSWORD = "password";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ROLE_ID,
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @param $scope
     * @return bool
     */
    public function may($scope): bool
    {
        $scopes = json_decode($this->role->scope);

        if (in_array($scope, $scopes))
            return true;

        return false;
    }

    /**
     * @return string
     */
    public function image(): string
    {
        return asset("favicon.ico");
    }

}
