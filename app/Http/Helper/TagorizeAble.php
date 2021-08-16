<?php


namespace App\Http\Helper;


use App\Models\Categorize;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait TagorizeAble
{
    /**
     * @return MorphMany
     */
    public function tagorize(): MorphMany
    {
        return $this->morphMany(Categorize::class,"tagorizeable")->with("tag");
    }
}
