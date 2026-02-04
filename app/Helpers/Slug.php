<?php

namespace App\Helpers;

use Normalizer;

class Slug
{
    public function slugify(string $text, string $divider = '-'): string
    {
        // 1. Trim
        $text = trim($text);

        // 2. Normalize Unicode (CRITICAL for Bengali)
        if (class_exists(Normalizer::class)) {
            $text = Normalizer::normalize($text, Normalizer::FORM_C);
        }

        // 3. Remove punctuation (keep letters, numbers, AND combining marks)
        $text = preg_replace('/[^\p{L}\p{N}\p{M}\s]+/u', '', $text);

        // 4. Replace whitespace with divider
        $text = preg_replace('/\s+/u', $divider, $text);

        // 5. Remove duplicate dividers
        $text = preg_replace('/' . preg_quote($divider, '/') . '+/', $divider, $text);

        // 6. Trim dividers
        $text = trim($text, $divider);

        // 7. Lowercase (Unicode-safe)
        $text = mb_strtolower($text, 'UTF-8');

        return $text !== '' ? $text : 'n-a';
    }
}
