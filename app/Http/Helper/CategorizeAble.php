<?php


namespace App\Http\Helper;


use App\Models\Categorize;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait CategorizeAble
{
    /**
     * @return MorphOne
     */
    public function categorize(): MorphOne
    {
        return $this->morphOne(Categorize::class, "categorizeable");
    }

}
