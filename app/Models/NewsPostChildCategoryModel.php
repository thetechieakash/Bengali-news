<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsPostChildCategoryModel extends Model
{
    protected $table = 'news_post_child_categories';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'news_post_id',
        'child_category_id'
    ];
    protected $useAutoIncrement = true;
}
