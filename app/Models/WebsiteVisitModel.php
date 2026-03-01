<?php

namespace App\Models;

use CodeIgniter\Model;

class WebsiteVisitModel extends Model
{
    protected $table = 'website_visits';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'ip_address',
        'visit_date'
    ];
}
