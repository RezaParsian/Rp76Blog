<?php

namespace App\Models;

use App\Http\Helper\CustomModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static paginate()
 * @method static create(array $array)
 */
class Tag extends Model
{
    use HasFactory,SoftDeletes,CustomModel;

    const TITLE = "title",
        SLUG = "slug";

    protected $fillable = [
        self::TITLE,
        self::SLUG,
    ];

	public function articles(): BelongsToMany
	{
		return $this->belongsToMany(Article::class,'article_tags');
	}
}
