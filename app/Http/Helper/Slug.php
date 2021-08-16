<?php


namespace App\Http\Helper;


use Illuminate\Support\Str;

class Slug
{
    public static function slugify($string, $separator = '-', $limit = 8): string
    {
        $string = strtolower($string);
        $string = str_replace('‌', ' ', $string);
        $string = Str::words($string, $limit, '');
        $string = mb_ereg_replace('([^آ-ی۰-۹a-z0-9]|-)+', $separator, $string);
        $string = strtolower($string);
        return trim($string, $separator);
    }
}
