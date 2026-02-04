<?php

namespace App\Models;

use CodeIgniter\Model;

class Categories extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'cat',
        'slug',
        'is_active',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'slug' => 'required|is_unique[categories.slug]',
    ];
    protected $validationMessages   = [
        'slug' => [
            'required' => 'Category name required',
            'is_unique' => 'Category already exists',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getAllCats()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
    public function getSpecificCatBySlug($slug)
    {
        return $this->where(['slug' => $slug, 'status' => 1])->first();
    }

    
    public function randomCategory($limit){
        $posts = $this->select('id, cat, slug')
            ->where('status', 1)
            ->orderBy('RAND()')
            ->limit($limit)
            ->get()
            ->getResultArray();
            return $posts;
    }
}
