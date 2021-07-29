<?php

namespace App\Http\Helper;

use Carbon\Carbon;

/**
 * Trait CustomModel
 * @package App\Http\Helper
 */
trait CustomModel
{
    /**
     * @return string
     */
    public function getCreatedAtPAttribute(): string
    {
        return $this->attributes["created_at"] ? Verta($this->attributes["created_at"])->formatDatetime() : "";
    }

    /**
     * @return string
     */
    public function getUpdatedAtPAttribute(): string
    {
        return $this->attributes["updated_at"] ? Verta($this->attributes["updated_at"])->formatDatetime() : "";
    }

    /**
     * @return string
     */
    public function getUpdatedAtDiffAttribute(): string
    {
        return $this->attributes["updated_at"] ? Carbon::make($this->attributes["updated_at"])->diffForHumans() : "";
    }

    /**
     * @return string
     */
    public function getCreatedAtDiffAttribute(): string
    {
        return $this->attributes["created_at"] ? Carbon::make($this->attributes["created_at"])->diffForHumans() : "";
    }
}
