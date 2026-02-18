<?php

namespace App\Models;

use CodeIgniter\Model;

class SubAuthorModel extends Model
{
    protected $table      = 'sub_authors';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'profile_image',
    ];

    protected $useTimestamps = false;
}
