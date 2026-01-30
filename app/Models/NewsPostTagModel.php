<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsPostTagModel extends Model
{
    protected $table      = 'news_post_tags';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'news_post_id',
        'tag_id',
    ];

}
