<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsPostModel extends Model
{
    protected $table            = 'news_posts';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields = [
        'headline',
        'slug',
        'author',
        'post_date_time',
        'short_description',
        'description',
        'status',
    ];

    /**
     * Get post by id
     */
    public function getPostById(int $postId)
    {
        return $this->select()->where('id', $postId)->first();
    }
    /**
     * Get post with categories, sub categories & tags
     */
    public function getPostWithRelations(int $postId)
    {
        return $this->select('news_posts.*')
            ->where('news_posts.id', $postId)
            ->first();
    }
    public function getPostForEdit(int|string $identifier): ?array
    {
        // Detect whether ID or slug
        if (is_numeric($identifier)) {
            $post = $this->where(['id' => (int) $identifier, 'status' => 1])->first();
        } else {
            $post = $this->where(['slug' => $identifier, 'status' => 1])->first();
        }

        if (!$post) {
            return null;
        }
        $postId = $post['id'];
        $db = db_connect();

        /** ---------- CATEGORIES ---------- */
        $post['categories'] = $db->table('news_post_categories npc')
            ->select([
                'c.id',
                'c.cat as name',
                'c.slug as slug'
            ])
            ->join('categories c', 'c.id = npc.category_id')
            ->where('npc.news_post_id', $postId)
            ->get()
            ->getResultArray();


        $post['subcategories'] = $db->table('news_post_sub_categories npsc')
            ->select([
                'sc.id',
                'sc.cat_id',
                'sc.sub_cat_name'
            ])
            ->join('sub_categories sc', 'sc.id = npsc.sub_category_id')
            ->where('npsc.news_post_id', $postId)
            ->get()
            ->getResultArray();
            
        $post['category_ids'] = array_column($post['categories'], 'id');
        $post['subcategory_ids'] = array_column($post['subcategories'], 'id');


        $post['tags'] = $db->table('news_post_tags npt')
            ->select('t.id, t.name')
            ->join('tags t', 't.id = npt.tag_id')
            ->where('npt.news_post_id', $postId)
            ->get()
            ->getResultArray();
        /** ---------- THUMBNAIL ---------- */
        $post['thumbnail'] = $db->table('news_post_thumbnails')
            ->where('news_post_id', $postId)
            ->get()
            ->getRowArray();

        return $post;
    }
}
