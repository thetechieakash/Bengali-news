<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TagModel;
use App\Models\NewsPostModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tag extends BaseController
{
    protected TagModel $tagModel;
    protected NewsPostModel $postModel;

    public function __construct()
    {
        $this->tagModel  = new TagModel();
        $this->postModel = new NewsPostModel();
    }

    public function index(string $identifier): string
    {
        // Find tag by name
        $tag = $this->tagModel->where('name', $identifier)->first();

        if (!$tag) {
            throw PageNotFoundException::forPageNotFound();
        }

        $posts = $this->getPostsByTag($tag['id']);

        $data = [
            'pageTitle' => 'Tag: ' . $tag['name'],
            'tag'       => $tag,
            'posts'     => $posts,
            'pager'     => $this->postModel->pager,
            'popularNews' => $this->postModel->popularNews(7),
        ];

        return view('user/Tag', array_merge($this->data, $data));
    }

    /**
     * Get paginated posts by tag
     */
    private function getPostsByTag(int $tagId, int $perPage = 5): array
    {
        return $this->postModel
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
                'news_post_tags nptg',
                'nptg.news_post_id = news_posts.id'
            )
            ->join(
                'news_post_thumbnails npt',
                'npt.news_post_id = news_posts.id',
                'left'
            )
            ->where('nptg.tag_id', $tagId)
            ->where('news_posts.status', 1)
            ->groupBy('news_posts.id')
            ->orderBy('news_posts.post_date_time', 'DESC')
            ->paginate($perPage, 'tag');
    }
}
