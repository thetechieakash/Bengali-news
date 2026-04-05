<?php

namespace App\Models;

use CodeIgniter\Model;

class ChildCategories extends Model
{
    protected $table            = 'child_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'sub_cat_id',
        'child_cat_name',
        'child_cat_slug',
        'is_active',
        'status'
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    /*
    |--------------------------------------------------------------------------
    | Custom Methods
    |--------------------------------------------------------------------------
    */

    public function getAllChildCats()
    {
        return $this->select('
            child_categories.*,
            sub_categories.sub_cat_name,
            sub_categories.cat_id AS category_id,
            categories.cat AS category_name
        ')
            ->join('sub_categories', 'sub_categories.id = child_categories.sub_cat_id', 'left')
            ->join('categories', 'categories.id = sub_categories.cat_id', 'left')
            ->orderBy('child_categories.created_at', 'DESC')
            ->findAll();
    }

    public function getChildBySubCatId($subCatId)
    {
        return $this->where([
            'sub_cat_id' => $subCatId,
            'status'     => 1
        ])
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    public function getChildBySlug($slug)
    {
        return $this->select('
                child_categories.*,
                sub_categories.sub_cat_slug,
                categories.slug AS category_slug
            ')
            ->join('sub_categories', 'sub_categories.id = child_categories.sub_cat_id', 'left')
            ->join('categories', 'categories.id = sub_categories.cat_id', 'left')
            ->where([
                'child_categories.child_cat_slug' => $slug,
                'child_categories.status'         => 1
            ])
            ->first();
    }
}
