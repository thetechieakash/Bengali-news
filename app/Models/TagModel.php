<?php

namespace App\Models;

use App\Helpers\Slug;
use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table            = 'tags';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'name',
    ];

    public function getOrCreate(string $name): int
    {
        $name = trim($name);

        $tag = $this
            ->where('LOWER(name)', mb_strtolower($name))
            ->first();

        if ($tag) {
            return (int) $tag['id'];
        }

        $this->insert(['name' => $name]);
        return $this->getInsertID();
    }
}
