<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsPostCategoryModel extends Model
{
    protected $table      = 'news_post_categories';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'news_post_id',
        'category_id',
    ];

}
