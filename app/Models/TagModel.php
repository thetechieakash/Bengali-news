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
    public function popularTags(int $limit = 15): array
    {
        return $this->db->table('tags t')
            ->select('
            t.id,
            t.name,
            COUNT(npt.news_post_id) as total_posts
        ')
            ->join('news_post_tags npt', 'npt.tag_id = t.id')
            ->join('news_posts np', 'np.id = npt.news_post_id')
            ->where('np.status', 1)
            ->groupBy('t.id')
            ->orderBy('total_posts', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }
}
