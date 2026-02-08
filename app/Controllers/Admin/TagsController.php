<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Slug;
use App\Models\TagModel;

class TagsController extends BaseController
{
    public function index()
    {
        $model = new TagModel();
        $tags = $model->orderBy('id', 'DESC')->findAll();
        $data = [
            'pageTitle' => 'Tags',
            'tags' => $tags,
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
}
