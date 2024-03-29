<?php

namespace App\Models;

use App\Http\Helper\{CustomModel, MetaAble};
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\{Eloquent\Factories\HasFactory, Eloquent\Relations\BelongsTo, Eloquent\SoftDeletes};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property mixed id
 * @property string $image
 * @property Role $role
 * @package App\Models
 * @method static orderBy(...$data)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, CustomModel, MetaAble;

    const ROLE_ID = "role_id",
        NAME = "name",
        EMAIL = "email",
        IMAGE = 'image',
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
        self::IMAGE,
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

    public function hasImage(): bool
    {
        return (bool)$this->getAttribute(self::IMAGE);
    }

    /**
     * @return string
     */
    public function getImageAttribute(): string
    {
        return $this->attributes[self::IMAGE] ? asset("upload/profile/" . $this->attributes[self::IMAGE]) : asset("favicon.ico");
    }
}
