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
    | Get Ads By Page + Position (Optimized for JSON columns)
    |--------------------------------------------------------------------------
    */
    public function getAdsForPage(string $page, string $position, bool $onlyImage = false): array
    {
        $pageJson     = $this->db->escape(json_encode($page));
        $positionJson = $this->db->escape(json_encode($position));

        $builder = $this->where('status', 1)
            ->where("JSON_CONTAINS(pages, $pageJson)", null, false)
            ->where("JSON_CONTAINS(position, $positionJson)", null, false);

        if ($onlyImage) {
            $builder->where('ad_type', 'image')
                ->where('image IS NOT NULL')
                ->where('image !=', '');
        }

        return $builder
            ->orderBy('id', 'DESC')
            ->findAll();
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
