<?php


namespace App\Http\Helper;


use App\Models\Categorize;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait CategorizeAble
{
    /**
     * @return MorphMany
     */
    public function categorize(): MorphMany
    {
        return $this->morphMany(Categorize::class,"categorizeable")->with("category");
    }
}
