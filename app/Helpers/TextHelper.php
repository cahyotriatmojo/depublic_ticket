<?php

namespace App\Helpers;

class TextHelper
{
    public static function truncate($text, $limit)
    {
        if (strlen($text) > $limit) {
            return substr($text, 0, $limit) . '...';
        }
        return $text;
    }
}
