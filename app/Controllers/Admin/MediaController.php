<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MediaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MediaController extends BaseController
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Media Manager',
        ];
        return view('admin/Media', $data);
    }
    
    public function upload()
    {
        $files = $this->request->getFiles();

        if (!isset($files['media'])) {
            return $this->response->setJSON([
                'success' => false,
                'error'   => 'No files selected'
            ]);
        }

        $mediaModel = new MediaModel();
        $folder = date('m_y');
        $path = FCPATH . "uploads/posts/thumbnails/$folder/";

        if (!is_dir($path)) {
            mkdir($path, 0775, true);
        }

        foreach ($files['media'] as $file) {

            if (!$file->isValid()) {
                continue;
            }

            $newName = $file->getRandomName();
            $file->move($path, $newName);

            $relativePath = "uploads/posts/thumbnails/$folder/$newName";

            $mediaModel->insert([
                'file_name' => $newName,
                'file_path' => $relativePath,
                'file_type' => $file->getClientMimeType(),
                'folder'    => $folder,
                'file_size' => $file->getSize()
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Files uploaded successfully.'
        ]);
    }

    public function delete($id)
    {
        $mediaModel = new MediaModel();
        $media = $mediaModel->find($id);

        if (!$media) {
            return $this->response->setJSON(['error' => 'Not found']);
        }

        if (file_exists($media['file_path'])) {
            unlink($media['file_path']);
        }

        $mediaModel->delete($id);

        return $this->response->setJSON(['success' => true]);
    }
    public function getMedia()
    {
        if (!$this->request->isAJAX()) {
            throw PageNotFoundException::forPageNotFound();
        }
        $page  = (int) ($this->request->getGet('page') ?? 1);
        $limit = 30;
        $offset = ($page - 1) * $limit;

        $mediaModel = new MediaModel();

        $media = $mediaModel
            ->orderBy('id', 'DESC')
            ->findAll($limit, $offset);

        return $this->response->setJSON([
            'data' => $media,
            'next_page' => count($media) === $limit ? $page + 1 : null
        ]);
    }
}
