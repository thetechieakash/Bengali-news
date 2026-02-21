<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdsModel;

class AdsController extends BaseController
{
    protected $adsModel;

    public function __construct()
    {
        $this->adsModel = new AdsModel();
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
                'error' => 'Ad not found'
            ]);
        }

        // Decode JSON fields
        $ad['pages'] = json_decode($ad['pages'], true);
        $ad['position'] = $ad['position'] ? json_decode($ad['position'], true) : [];

        return $this->response->setJSON([
            'success' => true,
            'data'    => $ad
        ]);
    }

    public function store()
    {
        $request = $this->request;
        if (!$request->isAJAX()) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid request'
            ])->setStatusCode(400);
        }
        // echo "<pre>";
        // print_r($request->getPost());
        // die();
        $adType  = $request->getPost('ad_type');

        // =============================
        // VALIDATION RULES
        // =============================

        $rules = [
            'title'   => 'required|max_length[150]',
            'ad_type' => 'required|in_list[image,script]',
            'pages'   => 'required'
        ];

        if ($adType === 'image') {
            $rules['image']    = 'uploaded[image]|is_image[image]';
            $rules['position'] = 'required';
        }

        if ($adType === 'script') {
            $rules['script'] = 'required';
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'errors' => $this->validator->getErrors()
            ]);
        }

        // =============================
        // DATA PREPARE
        // =============================

        $data = [
            'title'      => $request->getPost('title'),
            'ad_type'    => $adType,
            'pages'      => json_encode($request->getPost('pages')),
            'status'     => $request->getPost('status') === 'published' ? 1 : 0,
        ];

        // =============================
        // IMAGE TYPE
        // =============================

        if ($adType === 'image') {

            $image = $request->getFile('image');

            if ($image->isValid() && !$image->hasMoved()) {

                $newName = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads/ads', $newName);

                $data['image']     = $newName;
                $data['url']       = $request->getPost('redirect_url');
                $data['position']  = json_encode($request->getPost('position'));
            }
        }

        if ($adType === 'script') {
            $data['script'] = $request->getPost('script');
            $data['position'] = null;
            $data['url'] = null;
        }

        $this->adsModel->insert($data);

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
                'error' => 'Ad not found'
            ]);
        }

        $request = service('request');
        $adType  = $request->getPost('ad_type');

        $rules = [
            'title'   => 'required|max_length[150]',
            'ad_type' => 'required|in_list[image,script]',
            'pages'   => 'required'
        ];

        if ($adType === 'image') {
            $rules['position'] = 'required';
            // image is NOT required during update
        }

        if ($adType === 'script') {
            $rules['script'] = 'required';
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'title'   => $request->getPost('title'),
            'ad_type' => $adType,
            'pages'   => json_encode($request->getPost('pages')),
        ];

        if ($adType === 'image') {

            $image = $request->getFile('image');

            if ($image && $image->isValid() && !$image->hasMoved()) {

                // Delete old image
                if (!empty($ad['image']) && file_exists(ROOTPATH . 'public/uploads/ads/' . $ad['image'])) {
                    unlink(ROOTPATH . 'public/uploads/ads/' . $ad['image']);
                }

                $newName = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads/ads', $newName);

                $data['image'] = $newName;
            }

            $data['url']      = $request->getPost('redirect_url');
            $data['position'] = json_encode($request->getPost('position'));
            $data['script']   = null;
        }

        if ($adType === 'script') {

            // Delete old image if exists
            if (!empty($ad['image']) && file_exists(ROOTPATH . 'public/uploads/ads/' . $ad['image'])) {
                unlink(ROOTPATH . 'public/uploads/ads/' . $ad['image']);
            }

            $data['script']   = $request->getPost('script');
            $data['image']    = null;
            $data['url']      = null;
            $data['position'] = null;
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
            return $this->response->setJSON(['error' => 'Ad not found']);
        }

        if (!empty($ad['image']) && file_exists(ROOTPATH . 'public/uploads/ads/' . $ad['image'])) {
            unlink(ROOTPATH . 'public/uploads/ads/' . $ad['image']);
        }

        $this->adsModel->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Ad deleted successfully'
        ]);
    }
}
