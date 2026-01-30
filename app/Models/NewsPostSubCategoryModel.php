<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsPostSubCategoryModel extends Model
{
    protected $table      = 'news_post_sub_categories';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'news_post_id',
        'sub_category_id',
    ];

    protected $useAutoIncrement = true;
}
