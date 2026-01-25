<?php

namespace App\Models;

use CodeIgniter\Model;

class SubCategories extends Model
{
    protected $table            = 'sub_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'cat_id',
        'sub_cat_name',
        'sub_cat_slug',
        'is_active',
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'cat_id' => 'required',
        'sub_cat_slug' => 'required|is_unique[sub_categories.sub_cat_slug]'
    ];
    protected $validationMessages   = [
        'sub_cat_slug' => [
            'required' => 'Sub Category name required',
            'is_unique' => 'Sub Category shuould be unique'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getAllSubCats()
    {
        return $this->select('sub_categories.*,categories.cat AS category_name')
            ->join('categories', 'categories.id = sub_categories.cat_id' ,'left')
            ->findAll();
    }
}
