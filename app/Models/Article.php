<?php

namespace App\Models;

use App\Http\Helper\CustomModel;
use App\Http\Helper\Parsedown;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static limit(int $int)
 * @method static create(array $valid)
 * @method static orderBy(string $string, string $string1)
 * @method static where(...$data)
 * @property string content
 * @property int id
 * @property string $title
 * @property string $summary
 * @property string $slug
 * @property string $image
 * @property string $link
 * @property string $type
 */
class Article extends Model
{
    use HasFactory, SoftDeletes, CustomModel;

    const
        USER_ID = "user_id",
        CATEGORY_ID = 'category_id',
        TITLE = "title",
        SLUG = "slug",
        CONTENT = "content",
        IMAGE = "image",
        TYPE = "type";

    const TYPE_BLOG = 'blog',
        TYPE_TWIT = 'twit';

    protected $fillable = [
        self::USER_ID,
        self::TITLE,
        self::SLUG,
        self::CATEGORY_ID,
        self::CONTENT,
        self::IMAGE,
        self::TYPE,
    ];

    /**
     * @return string
     */
    public function getCustomDateAttribute(): string
    {
        return verta($this->attributes["created_at"])->format("%Y/%m/%d");
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
        return $parsedown->text($this->getAttribute(self::CONTENT));
    }

    public function getSummaryAttribute(): string
    {
        $re = '/<summary.*?>(.*?)<\/summary>/ms';
        preg_match_all($re, $this->Markdown, $matches, PREG_SET_ORDER, 0);
        return $matches[0][1] ?? "";
    }

    public function getLinkAttribute(): string
    {
        return route("post.single", $this->attributes["slug"]);
    }

    public function getImageAttribute(): string
    {
        return asset("upload/article/" . $this->attributes["image"]);
    }

    public function getImageNameAttribute()
    {
        return $this->attributes["image"];
    }

    public function getReadTimeAttribute(): string
    {
        $len = str_word_count($this->attributes[self::CONTENT]);
        return ((int)($len / 130) > 0 ? (int)($len / 130) : 1) . " دقیقه";
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
