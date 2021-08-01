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
 * @method static create(array $valid)
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

    const POST_TYPE=[
        "blog"=>"پست بلند",
        "twit"=>"پست کوتاه"
    ];

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
        "summary",
        "markdown",
        "link"
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
    public function getMarkdownAttribute(): string
    {
        $parsedown = new Parsedown();
        $parsedown->setSafeMode(true);
        $parsedown->setMarkupEscaped(true);
        return $parsedown->text($this->attributes["content"]);
    }

    public function getSummaryAttribute(): string
    {
        $re = '/<summary.*?>(.*?)<\/summary>/ms';
        preg_match_all($re, $this->Markdown, $matches, PREG_SET_ORDER, 0);
        return $matches[0][1] ?? "";
    }

    public function getLinkAttribute(): string
    {
       return route("post.single",$this->attributes["slug"]);
    }
}
