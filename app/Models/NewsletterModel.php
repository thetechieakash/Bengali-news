<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsletterModel extends Model
{
    protected $table      = 'newsletter_subscribers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'email',
        'token',
        'is_active',
        'last_sent_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
