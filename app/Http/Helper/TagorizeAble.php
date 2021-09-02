<?php


namespace App\Http\Helper;


use App\Models\Categorize;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait TagorizeAble
{
    /**
     * @return MorphToMany
     */
    public function tagorize(): MorphToMany
    {
        return $this->morphToMany(Tag::class,"tagorize","tagorizes");
    }
}
