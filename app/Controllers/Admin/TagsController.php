<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Slug;
use App\Models\TagModel;
use App\Models\NewsPostTagModel;

class TagsController extends BaseController
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Tags',
        ];
        return view('admin/Tags', $data);
    }

    public function createTag()
    {
        $tag = trim($this->request->getPost('tag'));

        if (!$tag) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tag name is required',
            ]);
        }

        $slug = new Slug();
        $tagSlug = $slug->slugify($tag);

        $model = new TagModel();

        // Correct duplicate check
        $existingTag = $model->where('name', $tagSlug)->first();
        if ($existingTag) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tag already exists',
            ]);
        }

        $model->insert([
            'name' => $tagSlug
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Tag saved successfully',
        ]);
    }

    public function updateTag()
    {
        $tagId = $this->request->getPost('id');
        $tag   = trim($this->request->getPost('tag'));

        if (!$tagId || !$tag) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request',
            ]);
        }

        $slug = new Slug();
        $tagSlug = $slug->slugify($tag);

        $model = new TagModel();

        $existingTag = $model->find($tagId);
        if (!$existingTag) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tag not found',
            ]);
        }

        if ($existingTag['name'] === $tagSlug) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No changes found',
            ]);
        }

        // Prevent duplicate on update
        if ($model->where('name', $tagSlug)->where('id !=', $tagId)->first()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tag already exists',
            ]);
        }

        $model->update($tagId, [
            'name' => $tagSlug
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Tag updated successfully',
        ]);
    }

    public function deleteTag()
    {
        $tagId = $this->request->getPost('id');

        if (!$tagId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request',
            ]);
        }

        $model = new TagModel();

        $existingTag = $model->find($tagId);
        if (!$existingTag) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tag not found',
            ]);
        }

        $model->delete($tagId);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Tag deleted successfully',
        ]);
    }
    public function getTagsList()
    {
        $request = service('request');
        $tagModel = new TagModel();

        $start  = (int) $request->getGet('start');
        $length = (int) $request->getGet('length');
        $draw   = (int) $request->getGet('draw');
        $search = $request->getGet('search')['value'] ?? '';

        $order         = $request->getGet('order');
        $orderColIndex = $order[0]['column'] ?? 0;
        $orderDir      = strtolower($order[0]['dir'] ?? 'desc');

        $columns = [
            0 => null,          // SL — not sortable
            1 => 'name',
        ];

        // Total records
        $totalRecords = $tagModel->countAll();

        // Base builder
        $builder = $tagModel->builder();

        // Search
        if (!empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->groupEnd();
        }

        // Filtered count
        $filteredRecords = $builder->countAllResults(false);

        // Sort
        if (isset($columns[$orderColIndex]) && $columns[$orderColIndex]) {
            $builder->orderBy($columns[$orderColIndex], $orderDir);
        } else {
            $builder->orderBy('id', 'DESC');
        }

        // Paginate
        $builder->limit($length, $start);
        $tags = $builder->get()->getResultArray();

        $data = [];
        $sl = $start;

        foreach ($tags as $tag) {
            $sl++;
            $data[] = [
                'sl'      => $sl . '.',
                'id'      => $tag['id'],
                'name'    => $tag['name'],
            ];
        }

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ]);
    }
}
