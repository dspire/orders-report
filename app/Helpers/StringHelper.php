<?php


namespace App\Helpers;


class StringHelper
{
    public static function checkSignsBy(string $pattern, string $str): bool
    {
        $matches = [];
        preg_match($pattern, $str, $matches);

        $val = array_values($matches)[0];
        return ($val === $str);
    }
}
