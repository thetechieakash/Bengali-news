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

        if (!isset($files['media']) || empty($files['media'])) {
            return $this->response->setJSON([
                'success' => false,
                'error'   => 'No files selected'
            ]);
        }

        $uploaded = 0;
        $errors   = [];

        foreach ($files['media'] as $file) {

            // Skip empty inputs (VERY IMPORTANT)
            if (!$file || $file->getError() === 4) {
                continue;
            }

            try {
                $result = uploadImage($file);

                if ($result) {
                    $uploaded++;
                } else {
                    $errors[] = $file->getClientName() . ' failed';
                }
            } catch (\Throwable $e) {
                $errors[] = $e->getMessage();
                log_message('error', $file->getClientName() . ' : ' . $e->getMessage());
            }
        }

        // No file uploaded at all
        if ($uploaded === 0) {
            return $this->response->setJSON([
                'success' => false,
                'message'   => 'No valid images uploaded',
                'error' => $errors
            ]);
        }

        // Success
        return $this->response->setJSON([
            'success' => true,
            'message' => "$uploaded image(s) uploaded successfully",
            'error'  => $errors // optional (for partial fail)
        ]);
    }

    public function delete($id)
    {
        $mediaModel = new MediaModel();
        $media = $mediaModel->find($id);
        if (!$media) {
            return $this->response->setJSON(['error' => 'Not found']);
        }
        if (file_exists(FCPATH . $media['file_path'])) {
            unlink(FCPATH . $media['file_path']);
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
        $search = $this->request->getGet('search');
        $limit = 30;
        $offset = ($page - 1) * $limit;
        $mediaModel = new MediaModel();
        $builder = $mediaModel
            ->like('file_type', 'image', 'after')
            ->orderBy('id', 'DESC');
        if ($search) {
            $builder->like('file_name', $search);
        }
        $media = $builder->findAll($limit, $offset);
        return $this->response->setJSON([
            'data' => $media,
            'next_page' => count($media) === $limit ? $page + 1 : null
        ]);
    }
}
