<?php

namespace App\Libraries;

use App\Models\Categories;
use App\Models\SubCategories;
use Config\Services;

class CategoryService
{
    public static function getNavbarCategories()
    {
        $cache = Services::cache();

        // try cache first
        $categories = $cache->get('navbar_categories');

        if ($categories !== null) {
            return $categories;
        }

        // DB call ONLY if cache is empty
        $catModel = new Categories();
        $subModel = new SubCategories();

        $categories = [];

        $cats = $catModel
            ->where('is_active', 1)
            ->where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        foreach ($cats as $cat) {
            $subs = $subModel
                ->where('cat_id', $cat['id'])
                ->where('is_active', 1)
                ->where('status', 1)
                ->orderBy('created_at', 'ASC')
                ->findAll();

            $categories[] = [
                'id'   => $cat['id'],
                'name' => $cat['cat'],
                'slug' => $cat['slug'],
                'subs' => $subs
            ];
        }

        // cache for 1 hour (3600 seconds)
        $cache->save('navbar_categories', $categories, 3600);

        return $categories;
    }
}
