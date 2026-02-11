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

    // Frontend / public use ONLY
    public function getActivePostForUser(string $slug)
    {
        return $this->getPostWithRelations($slug, true);
    }
    // Admin / internal use (unchanged behavior)
    public function getPostForEdit(int|string $identifier): ?array
    {
        return $this->getPostWithRelations($identifier, false);
    }

    protected function getPostWithRelations(int|string $identifier, bool $onlyActive): ?array
    {
        $builder = $this->builder();

        if (is_numeric($identifier)) {
            $builder->where('id', (int) $identifier);
        } else {
            $builder->where('slug', $identifier);
        }

        if ($onlyActive) {
            $builder->where('status', 1);
        }

        $post = $builder->get()->getRowArray();

        if (!$post) {
            return null;
        }

        $postId = $post['id'];
        $db = db_connect();

        /** ---------- CATEGORIES ---------- */
        $post['categories'] = $db->table('news_post_categories npc')
            ->select('c.id, c.cat AS name, c.slug')
            ->join('categories c', 'c.id = npc.category_id')
            ->where('npc.news_post_id', $postId)
            ->get()
            ->getResultArray();

        /** ---------- SUBCATEGORIES ---------- */
        $post['subcategories'] = $db->table('news_post_sub_categories npsc')
            ->select('sc.id, sc.cat_id, sc.sub_cat_name')
            ->join('sub_categories sc', 'sc.id = npsc.sub_category_id')
            ->where('npsc.news_post_id', $postId)
            ->get()
            ->getResultArray();

        $post['category_ids']    = array_column($post['categories'], 'id');
        $post['subcategory_ids'] = array_column($post['subcategories'], 'id');

        /** ---------- TAGS ---------- */
        $post['tags'] = $db->table('news_post_tags npt')
            ->select('t.id, t.name') // name not id (err)
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

    public function readMore(int $currentPostId, int $limit = 4): array
    {
        return $this->select('
            news_posts.id,
            news_posts.headline,
            news_posts.slug,
            news_posts.author,
            news_posts.post_date_time,
            npt.thumbnail_url
        ')
            ->join(
                'news_post_thumbnails npt',
                'npt.news_post_id = news_posts.id',
                'left'
            )
            ->where('news_posts.status', 1)
            ->where('news_posts.id !=', $currentPostId)
            ->orderBy('news_posts.post_date_time', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getPostsByCategoryAndSubCategory(int $categoryId, int $subCategoryId, int $perPage = 10)
    {
        return $this->where('category_id', $categoryId)
            ->where('sub_category_id', $subCategoryId)
            ->where('status', 1) // published only
            ->orderBy('published_at', 'DESC')
            ->paginate($perPage);
    }

    public function popularNews(int $limit)
    {
        $popularNews = $this
            ->select('
        news_posts.id,
        news_posts.headline,
        news_posts.slug,
        news_posts.author,
        news_posts.post_date_time,
        news_posts.short_description,
        npt.thumbnail_url
    ')
            ->join(
                'news_post_thumbnails npt',
                'npt.news_post_id = news_posts.id',
                'left'
            )
            ->where('news_posts.status', 1)
            ->orderBy('news_posts.post_date_time', 'DESC')
            ->orderBy('RAND()')
            ->limit($limit)
            ->findAll();
        return $popularNews;
    }
    public function postDuration(int $fromDays, int $toDays, int $limit = 5): array
    {
        $fromDate = date('Y-m-d 00:00:00', strtotime("-{$fromDays} days"));
        $toDate   = date('Y-m-d 23:59:59', strtotime("-{$toDays} days"));

        return $this
            ->select('
            news_posts.id,
            news_posts.headline,
            news_posts.slug,
            news_posts.short_description,
            news_posts.author,
            news_posts.post_date_time,
            npt.thumbnail_url
        ')
            ->join(
                'news_post_thumbnails npt',
                'npt.news_post_id = news_posts.id',
                'left'
            )
            ->where('news_posts.status', 1)
            ->where('news_posts.post_date_time >=', $fromDate)
            ->where('news_posts.post_date_time <=', $toDate)
            ->orderBy('news_posts.post_date_time', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function headlineTicker()
    {
        return $this
            ->select('headline, slug')
            ->where('status', 1)
            ->orderBy('RAND()')
            ->findAll(10);
    }

    public function relatedPosts(
        int $postId,
        array $categoryIds = [],
        array $subCategoryIds = [],
        int $limit = 6
    ): array {

        $builder = $this->select('
        news_posts.id,
        news_posts.headline,
        news_posts.slug,
        news_posts.post_date_time,
        npt.thumbnail_url
    ')
            ->join(
                'news_post_thumbnails npt',
                'npt.news_post_id = news_posts.id',
                'left'
            )
            ->where('news_posts.status', 1)
            ->where('news_posts.id !=', $postId);

        // ---------- Sub Category (Highest Priority)
        if (!empty($subCategoryIds)) {
            $builder->join(
                'news_post_sub_categories npsc',
                'npsc.news_post_id = news_posts.id'
            )->whereIn('npsc.sub_category_id', $subCategoryIds);
        }

        // ---------- Category (Fallback)
        if (!empty($categoryIds)) {
            $builder->join(
                'news_post_categories npc',
                'npc.news_post_id = news_posts.id',
                'left'
            )->orWhereIn('npc.category_id', $categoryIds);
        }

        return $builder
            ->groupBy('news_posts.id')
            ->orderBy('news_posts.post_date_time', 'DESC')
            ->limit($limit)
            ->findAll();
    }
    public function fuzzySearch(string $keyword, int $perPage = 5)
    {
        $keywords = array_filter(explode(' ', trim($keyword)));

        $builder = $this->select('
            news_posts.id,
            news_posts.headline,
            news_posts.slug,
            news_posts.short_description,
            news_posts.author,
            news_posts.post_date_time,
            npt.thumbnail_url
        ')
            ->join('news_post_thumbnails npt', 'npt.news_post_id = news_posts.id', 'left')
            ->join('news_post_categories npc', 'npc.news_post_id = news_posts.id', 'left')
            ->join('categories c', 'c.id = npc.category_id', 'left')
            ->join('news_post_sub_categories npsc', 'npsc.news_post_id = news_posts.id', 'left')
            ->join('sub_categories sc', 'sc.id = npsc.sub_category_id', 'left')
            ->join('news_post_tags nptag', 'nptag.news_post_id = news_posts.id', 'left')
            ->join('tags t', 't.id = nptag.tag_id', 'left')
            ->where('news_posts.status', 1);

        $builder->groupStart();

        foreach ($keywords as $word) {
            $builder->orLike('news_posts.headline', $word);
            $builder->orLike('news_posts.description', $word);
            $builder->orLike('c.slug', $word);
            $builder->orLike('sc.sub_cat_name', $word);
            $builder->orLike('t.name', $word);
        }

        $builder->groupEnd();

        $builder->groupBy('news_posts.id')
            ->orderBy('news_posts.post_date_time', 'DESC');

        return $this->paginate($perPage);
    }
}
