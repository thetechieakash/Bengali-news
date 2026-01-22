<?php

namespace App\Models;

use CodeIgniter\Model;

class Catagories extends Model
{
    protected $table            = 'catagories';
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
        'slug' => 'required|is_unique[catagories.slug]',
    ];
    protected $validationMessages   = [
        'slug' => [
            'required' => 'Category name required',
            'is_unique' => 'Category already exists',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getAllCats(){
        return $this->findAll();
    }
}
