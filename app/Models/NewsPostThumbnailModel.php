<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsPostThumbnailModel extends Model
{
    protected $table      = 'news_post_thumbnails';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'news_post_id',
        'type',
        'thumbnail_url',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
