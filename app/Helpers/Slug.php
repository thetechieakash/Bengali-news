<?php

namespace App\Helpers;

class Slug
{
    public function slugify(string $text, string $divider = '-'): string
    {
        // 1. Normalize whitespace
        $text = trim($text);

        // 2. Remove punctuation & symbols (keep letters & numbers of all languages)
        $text = preg_replace('/[^\p{L}\p{N}\s]+/u', '', $text);

        // 3. Replace spaces with divider
        $text = preg_replace('/\s+/u', $divider, $text);

        // 4. Remove duplicate dividers
        $text = preg_replace('/' . preg_quote($divider, '/') . '+/', $divider, $text);

        // 5. Trim divider
        $text = trim($text, $divider);

        // 6. Lowercase (Unicode-safe)
        $text = mb_strtolower($text, 'UTF-8');

        return $text ?: 'n-a';
    }
}
