<?php

namespace App\Helpers;


class StringShort
{
    /**
     * Truncate a string and add dots if needed (UTF-8 safe)
     *
     * @param string $text
     * @param int    $limit
     * @param string $end
     * @return string
     */
    public static function truncate(string $text, int $limit = 60, string $end = '...'): string
    {
        $text = trim(strip_tags($text));

        if (mb_strlen($text) <= $limit) {
            return $text;
        }

        $cut = mb_substr($text, 0, $limit);

        // prevent breaking last word
        $cut = preg_replace('/\s+\S*$/u', '', $cut);

        return $cut . $end;
    }
}
