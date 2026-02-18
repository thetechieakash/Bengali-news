<?php

namespace App\Models;

use CodeIgniter\Model;

class PostViewModel extends Model
{
    protected $table      = 'post_views';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'post_id',
        'ip_address',
        'viewed_at'
    ];

    protected $useTimestamps = false;
}
