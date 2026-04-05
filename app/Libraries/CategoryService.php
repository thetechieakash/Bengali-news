<?php

namespace App\Libraries;

use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ChildCategories;
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

        $catModel   = new Categories();
        $subModel   = new SubCategories();
        $childModel = new ChildCategories();

        $categories = [];

        $cats = $catModel
            ->where('status', 1)
            ->orderBy('position', 'ASC')
            ->findAll();

        foreach ($cats as $cat) {

            // Load sub categories
            $subsData = $subModel
                ->where('cat_id', $cat['id'])
                ->orderBy('created_at', 'ASC')
                ->findAll();

            $subs = [];

            foreach ($subsData as $sub) {

                // Load child categories
                $children = $childModel
                    ->where('sub_cat_id', $sub['id'])
                    ->orderBy('created_at', 'ASC')
                    ->findAll();

                $subs[] = [
                    'id'       => $sub['id'],
                    'name'     => $sub['sub_cat_name'],
                    'slug'     => $sub['sub_cat_slug'],
                    'children' => $children
                ];
            }

            $categories[] = [
                'id'        => $cat['id'],
                'name'      => $cat['cat'],
                'slug'      => $cat['slug'],
                'position'  => $cat['position'],
                'is_active' => $cat['is_active'],
                'subs'      => $subs
            ];
        }

        // Cache for 1 hour
        $cache->save('navbar_categories', $categories, 3600);

        return $categories;
    }
}
