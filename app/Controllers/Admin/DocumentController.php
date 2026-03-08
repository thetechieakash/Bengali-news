<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MediaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class DocumentController extends BaseController
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Documents Manager',
        ];
        return view('admin/Documents', $data);
    }

    public function upload()
    {
        $files = $this->request->getFiles();

        if (!isset($files['document'])) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'No files selected'
            ]);
        }

        $docModel = new MediaModel();

        $year  = date('Y');
        $month = date('m');

        $path = FCPATH . "uploads/$year/$month/documents/";

        if (!is_dir($path)) {
            mkdir($path, 0775, true);
        }

        foreach ($files['document'] as $file) {

            if (!$file->isValid()) {
                continue;
            }

            if ($file->getClientMimeType() !== 'application/pdf') {
                continue;
            }

            $originalName = $file->getClientName();

            $fileName = preg_replace('/[^A-Za-z0-9\-\_\.]/', '-', $originalName);

            $targetPath = $path . $fileName;

            $i = 1;
            $nameOnly = pathinfo($fileName, PATHINFO_FILENAME);
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);

            while (file_exists($targetPath)) {
                $fileName = $nameOnly . '-' . $i . '.' . $ext;
                $targetPath = $path . $fileName;
                $i++;
            }

            $file->move($path, $fileName);

            $relativePath = "uploads/$year/$month/documents/$fileName";

            $docModel->insert([
                'file_name' => $fileName,
                'file_path' => $relativePath,
                'file_type' => $file->getClientMimeType(),
                'folder'    => "$year/$month/documents",
                'file_size' => $file->getSize()
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'PDF uploaded successfully'
        ]);
    }

    public function delete($id)
    {
        $docModel = new MediaModel();
        $doc = $docModel->find($id);
        if (!$doc) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Document not found'
            ]);
        }
        $filePath = FCPATH . $doc['file_path'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $docModel->delete($id);
        return $this->response->setJSON([
            'success' => true
        ]);
    }


    public function getDocuments()
    {
        if (!$this->request->isAJAX()) {
            throw PageNotFoundException::forPageNotFound();
        }
        $page  = (int) ($this->request->getGet('page') ?? 1);
        $search = $this->request->getGet('search');
        $limit = 30;
        $offset = ($page - 1) * $limit;
        $docModel = new MediaModel();
        $builder = $docModel
            ->where('file_type', 'application/pdf')
            ->orderBy('id', 'DESC');
        if ($search) {
            $builder->like('file_name', $search);
        }
        $docs = $builder->findAll($limit, $offset);
        return $this->response->setJSON([
            'data' => $docs,
            'next_page' => count($docs) === $limit ? $page + 1 : null
        ]);
    }
}
