<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdsModel;

class AdsController extends BaseController
{
    protected $adsModel;
    protected $uploadPath;

    public function __construct()
    {
        $this->adsModel = new AdsModel();
        $this->uploadPath = FCPATH . 'uploads/ads/';

        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Ads',
            'ads' => $this->adsModel->orderBy('id', 'DESC')->findAll()
        ];

        return view('admin/Ads', $data);
    }

    public function getAd($id)
    {
        $ad = $this->adsModel->find($id);

        if (!$ad) {
            return $this->response->setJSON([
                'success' => false
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $ad
        ]);
    }

    public function store()
    {
        $request = $this->request;

        $rules = [
            'title' => 'required|max_length[150]',
            'ad_type' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'errors' => $this->validator->getErrors()
            ]);
        }

        $title     = $request->getPost('title');
        $adType    = $request->getPost('ad_type');
        $pages     = $request->getPost('pages') ?? [];
        $positions = $request->getPost('position') ?? [];

        /* ---------------- SCRIPT AD ---------------- */

        if ($adType == "script") {

            $this->adsModel->insert([
                'title' => $title,
                'ad_type' => 'script',
                'script' => $request->getPost('script'),
                'pages' => json_encode($pages),
                'status' => 1
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Script ad created'
            ]);
        }

        /* ---------------- IMAGE ADS ---------------- */

        foreach ($positions as $pos) {

            $file = $request->getFile("position_images.$pos");

            if ($file && $file->isValid() && !$file->hasMoved()) {

                $newName = $file->getRandomName();
                $file->move($this->uploadPath, $newName);

                $redirectUrl = $request->getPost($pos . '_redirect_url');

                $data = [

                    'title' => $title,
                    'ad_type' => 'image',
                    'image' => 'uploads/ads/' . $newName,
                    'url' => $redirectUrl,
                    'pages' => json_encode($pages),
                    'position' => $pos,
                    'status' => 1

                ];

                $this->adsModel->insert($data);
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Ad created successfully'
        ]);
    }

    public function toggleStatus()
    {
        $id = $this->request->getPost('id');
        $ad = $this->adsModel->find($id);

        if (!$ad) {
            return $this->response->setJSON(['error' => 'Ad not found']);
        }

        $this->adsModel->update($id, [
            'status' => $ad['status'] ? 0 : 1
        ]);

        return $this->response->setJSON([
            'success' => true
        ]);
    }

    public function update($id)
    {
        $ad = $this->adsModel->find($id);

        if (!$ad) {
            return $this->response->setJSON([
                'success' => false
            ]);
        }

        $request = $this->request;

        $title = $request->getPost('title');
        $pages = $request->getPost('pages') ?? [];

        $data = [
            'title' => $title,
            'pages' => json_encode($pages)
        ];

        if ($request->getPost('edit-ad-type') == "script") {

            $data['script'] = $request->getPost('script');
        }

        if ($request->getPost('edit-ad-type') == "image") {

            $pos = $ad['position'];

            $file = $request->getFile("position_images.$pos");

            if ($file && $file->isValid()) {

                if (!empty($ad['image']) && file_exists(FCPATH . $ad['image'])) {
                    unlink(FCPATH . $ad['image']);
                }

                $newName = $file->getRandomName();
                $file->move($this->uploadPath, $newName);

                $data['image'] = 'uploads/ads/' . $newName;
            }

            $data['url'] = $request->getPost($pos . '_redirect_url');
        }

        $this->adsModel->update($id, $data);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Ad updated successfully'
        ]);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        $ad = $this->adsModel->find($id);

        if (!$ad) {
            return $this->response->setJSON([
                'success' => false,
                'messagw' => "Can't find add"
            ]);
        }

        if (!empty($ad['image']) && file_exists(FCPATH . $ad['image'])) {
            unlink(FCPATH . $ad['image']);
        }

        $this->adsModel->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Ad deleted'
        ]);
    }
}
