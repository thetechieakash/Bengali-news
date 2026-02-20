<?php

namespace App\Models;

use CodeIgniter\Model;

class AdsModel extends Model
{
    protected $table      = 'ads';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'title',
        'ad_type',
        'image',
        'url',
        'script',
        'pages',
        'position',
        'view_count',
        'click_count',
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /*
    |--------------------------------------------------------------------------
    | Get Active Ads By Position
    |--------------------------------------------------------------------------
    */
    public function getActiveAdsByPosition(string $position)
    {
        return $this->where('status', 1)
            ->where('position', $position)
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    /*
    |--------------------------------------------------------------------------
    | Get Ads By Page + Position
    |--------------------------------------------------------------------------
    */
    public function getAdsForPage(string $page, string $position)
    {
        $ads = $this->getActiveAdsByPosition($position);

        return array_filter($ads, function ($ad) use ($page) {
            return in_array($page, $ad['pages'] ?? []);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Increment View Count
    |--------------------------------------------------------------------------
    */
    public function incrementView(int $id)
    {
        return $this->set('view_count', 'view_count+1', false)
            ->where('id', $id)
            ->update();
    }

    /*
    |--------------------------------------------------------------------------
    | Increment Click Count
    |--------------------------------------------------------------------------
    */
    public function incrementClick(int $id)
    {
        return $this->set('click_count', 'click_count+1', false)
            ->where('id', $id)
            ->update();
    }
}
