<?php

use App\Models\MediaModel;

if (!function_exists('generateUniqueFileName')) {
    function generateUniqueFileName(string $path, string $originalName): string
    {
        // Extract extension safely
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        // Remove extension from name
        $nameOnly = pathinfo($originalName, PATHINFO_FILENAME);

        // Clean name (ONLY letters + numbers)
        $nameOnly = preg_replace('/[^A-Za-z0-9]/', '-', $nameOnly);

        // Remove multiple dashes
        $nameOnly = preg_replace('/-+/', '-', $nameOnly);

        // Trim dashes
        $nameOnly = trim($nameOnly, '-');

        // Limit length (VERY IMPORTANT)
        $nameOnly = substr($nameOnly, 0, 50);

        // Final filename
        $fileName = $nameOnly . '.' . $ext;

        $i = 1;
        while (file_exists($path . $fileName)) {
            $fileName = $nameOnly . '-' . $i . '.' . $ext;
            $i++;
        }

        return $fileName;
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($file, string $folder = 'images'): ?string
    {
        if (!$file) {
            throw new \Exception('No file received');
        }

        if ($file->getError() === 4) {
            throw new \Exception('Empty file input');
        }

        if ($file->getError() === UPLOAD_ERR_INI_SIZE) {
            throw new \Exception('File too large. Max allowed: ' . ini_get('upload_max_filesize'));
        }

        if (!$file->isValid()) {
            throw new \Exception($file->getErrorString());
        }

        // safer extension
        $ext = strtolower($file->getClientExtension());

        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            throw new \Exception('Invalid image type.');
        }

        $year  = date('Y');
        $month = date('m');

        $path = FCPATH . "uploads/$year/$month/$folder/";

        if (!is_dir($path)) {
            mkdir($path, 0775, true);
        }

        $originalName = $file->getClientName();
        $newName = generateUniqueFileName($path, $originalName);

        if (!$file->move($path, $newName)) {
            throw new \Exception('Failed to move uploaded file');
        }
        $fullPath = $path . $newName;
        compressImage($fullPath, $ext);
        $relativePath = "uploads/$year/$month/$folder/$newName";

        try {
            (new \App\Models\MediaModel())->insert([
                'file_name' => $newName,
                'file_path' => $relativePath,
                'file_type' => 'image',
                'folder'    => "$year/$month/$folder",
                'file_size' => $file->getSize()
            ]);
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
        }

        return $relativePath;
    }
}
if (!function_exists('compressImage')) {
    function compressImage(string $filePath, string $ext): void
    {
        $ext = strtolower($ext);

        // Get original size
        $filesize = filesize($filePath);

        // Decide quality based on size
        if ($filesize > 5 * 1024 * 1024) {        // >5MB
            $quality = 60;
        } elseif ($filesize > 2 * 1024 * 1024) {  // >2MB
            $quality = 70;
        } else {
            $quality = 80;
        }

        switch ($ext) {

            case 'jpg':
            case 'jpeg':
                $image = @imagecreatefromjpeg($filePath);
                if (!$image) return;

                // Fix orientation (important for mobile images)
                if (function_exists('exif_read_data')) {
                    $exif = @exif_read_data($filePath);
                    if (!empty($exif['Orientation'])) {
                        switch ($exif['Orientation']) {
                            case 3:
                                $image = imagerotate($image, 180, 0);
                                break;
                            case 6:
                                $image = imagerotate($image, -90, 0);
                                break;
                            case 8:
                                $image = imagerotate($image, 90, 0);
                                break;
                        }
                    }
                }

                imagejpeg($image, $filePath, $quality);
                $image = null;
                break;


            case 'png':
                $image = @imagecreatefrompng($filePath);
                if (!$image) return;

                // Convert PNG → JPG if large (huge size saver )
                if ($filesize > 2 * 1024 * 1024) {

                    $jpgPath = preg_replace('/\.png$/i', '.jpg', $filePath);

                    imagejpeg($image, $jpgPath, 75);
                    $image = null;

                    unlink($filePath); // remove original PNG
                    rename($jpgPath, $filePath); // replace

                } else {
                    imagepng($image, $filePath, 6);
                    $image = null;
                }

                break;


            case 'webp':
                $image = @imagecreatefromwebp($filePath);
                if (!$image) return;

                imagewebp($image, $filePath, $quality);
                $image = null;
                break;


            case 'gif':
                // Skip GIF (optional: convert to video or keep original)
                break;
        }
    }
}