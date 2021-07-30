<?php

namespace App\Models;

use App\Http\Helper\CustomModel;
use App\Http\Helper\Parsedown;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static limit(int $int)
 * @property mixed content
 */
class Article extends Model
{
    use HasFactory, SoftDeletes, CustomModel;

    const
        USER_ID = "user_id",
        TITLE = "title",
        SLUG = "slug",
        CONTENT = "content",
        IMAGE = "image",
        TYPE = "type";

    protected $fillable = [
        self::USER_ID,
        self::TITLE,
        self::SLUG,
        self::CONTENT,
        self::IMAGE,
        self::TYPE,
    ];

    protected $appends = [
        "created_at_p",
        "created_at_diff",
        "updated_at_p",
        "updated_at_diff",
        "custom_date",
        "summary"
    ];

    /**
     * @return string
     */
    public function getCustomDateAttribute(): string
    {
        return verta($this->attributes["created_at"])->format("l %d %B ماه %Y");
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string
     */
    public function getContentAttribute(): string
    {
        $parsedown = new Parsedown();
        $parsedown->setSafeMode(true);
        $parsedown->setMarkupEscaped(true);
        return $parsedown->text($this->attributes["content"]);
    }

    public function getSummaryAttribute(): string
    {
        $re = '/<summary.*?>(.*?)<\/summary>/ms';
        preg_match_all($re, $this->content, $matches, PREG_SET_ORDER, 0);
        return $matches[0][1] ?? "";
    }
}
