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
    public function getPostForEdit(int $postId): ?array
    {
        $post = $this->where('id', $postId)->first();

        if (!$post) {
            return null;
        }

        $db = db_connect();

        /** ---------- CATEGORIES ---------- */
        $post['categories'] = array_column(
            $db->table('news_post_categories')
                ->select('category_id')
                ->where('news_post_id', $postId)
                ->get()
                ->getResultArray(),
            'category_id'
        );

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
