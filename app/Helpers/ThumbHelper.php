<?php

namespace App\Helpers;

class ThumbHelper
{
    /**
     * Returns a safe thumbnail URL
     *
     * @param string|null $thumb The thumbnail path or link
     * @param string|null $type  Type: 'image', 'media', or 'link'
     * @param string|null $default Optional default URL
     * @return string Full URL to thumbnail
     */
    public static function getThumbUrl(?string $thumb, ?string $type = null, ?string $default = null): string
    {
        $default = $default ?? base_url('assets/images/news/placeholder.png');

        if (!$thumb) {
            return $default;
        }

        if (in_array($type, ['image', 'media'], true)) {
            return base_url($thumb); // local paths
        }

        if ($type === 'link') {
            return $thumb; 
        }

        return $default;
    }
}
