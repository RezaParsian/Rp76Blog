<?php


namespace App\Http\Helper;


use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait CategorizeAble
{
    /**
     * @return MorphToMany
     */
    public function categorize(): MorphToMany
    {
        return $this->morphToMany(Category::class,"categorizeable","categorizes");
    }
}
