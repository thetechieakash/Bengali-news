<?php

namespace App\Helpers;

class Upload
{
    function uploadImage($request, string $inputName, string $destination = 'uploads/images'): string
    {
        $file = $request->getFile($inputName);

        if (!$file || !$file->isValid()) {
            throw new \Exception('Invalid file upload');
        }

        // Optional: validate MIME type
        if (!in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])) {
            throw new \Exception('Only JPG, PNG, WEBP allowed');
        }

        $newName = $file->getRandomName();
        $file->move($destination, $newName);

        return base_url("$destination/$newName");
    }
}
