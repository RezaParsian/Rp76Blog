<?php

namespace App\Http\Helper;

use App\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MetaAble
{
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, "metaable");
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setMeta($key, $value): self
    {
        $meta = $this->getMeta($key);
        if (!$meta)
            $this->meta()->create([Meta::KEY => $key, Meta::VALUE => $value]);
        else
            $this->meta()->where(Meta::KEY, $key)->update([Meta::KEY => $key, Meta::VALUE => $value]);

        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getMeta($key)
    {
        return $this->meta->where(Meta::KEY, $key)->first();
    }

    /**
     * @return mixed
     */
    public function getMetas()
    {
        return $this->meta;
    }
}
