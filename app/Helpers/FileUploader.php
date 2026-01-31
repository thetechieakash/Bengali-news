<?php

namespace App\Helpers;

use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Files\FileSizeUnit;

class FileUploader
{

    // File type, max size in kb and destination 
    protected $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    protected $maxSizeKB = 2048;
    protected $destination;

    public function __construct(string $destination)
    {
        $this->destination = rtrim($destination, '/\\') . '/';

        if (!is_dir($this->destination)) {
            mkdir($this->destination, 0755, true);
        }
    }

    public function setAllowedTypes(array $types): self
    {
        $this->allowedTypes = $types;
        return $this;
    }

    public function setMaxSizeKB(int $size): self
    {
        $this->maxSizeKB = $size;
        return $this;
    }

    //  Handle single file upload
    public function upload(UploadedFile $file): array
    {
        return $this->processFile($file);
    }

    //  Handle multiple file uploads
    public function uploadMultiple(array $files): array
    {
        $results = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $results[] = $this->processFile($file);
            }
        }

        return $results;
    }
    // Compress Image
    protected function compressImage(string $filePath, int $quality = 85): bool
    {
        $info = getimagesize($filePath);
        if (!$info) {
            return false;
        }

        $image = match ($info['mime']) {
            'image/jpeg' => imagecreatefromjpeg($filePath),
            'image/png'  => imagecreatefrompng($filePath),
            'image/webp' => imagecreatefromwebp($filePath),
            default      => null,
        };

        if (!$image) {
            return false;
        }

        $result = match ($info['mime']) {
            'image/jpeg' => imagejpeg($image, $filePath, $quality),
            'image/png'  => imagepng($image, $filePath, 6),
            'image/webp' => imagewebp($image, $filePath, $quality),
        };

        unset($image); // ✅ replaces deprecated imagedestroy()

        return $result;
    }

    // Convert to WebP
    protected function convertToWebP(
        string $sourcePath,
        string $destinationPath,
        int $quality = 85
    ): bool {
        $info = getimagesize($sourcePath);
        if (!$info) {
            return false;
        }

        $image = match ($info['mime']) {
            'image/jpeg' => imagecreatefromjpeg($sourcePath),
            'image/png'  => imagecreatefrompng($sourcePath),
            'image/webp' => imagecreatefromwebp($sourcePath),
            default      => null,
        };

        if (!$image) {
            return false;
        }

        // Preserve transparency (important for PNGs)
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        $result = imagewebp($image, $destinationPath, $quality);

        unset($image); // ✅ modern cleanup

        return $result;
    }


    // Internal reusable upload logic
    protected function processFile(UploadedFile $file): array
    {
        if (!$file->isValid()) {
            return ['status' => false, 'message' => 'Invalid file.'];
        }

        if ($file->hasMoved()) {
            return ['status' => false, 'message' => 'File already moved.'];
        }

        if (!in_array($file->getMimeType(), $this->allowedTypes)) {
            return ['status' => false, 'message' => 'File type not allowed.'];
        }

        if ($file->getSizeByBinaryUnit(FileSizeUnit::KB) > $this->maxSizeKB) {
            return ['status' => false, 'message' => 'File size exceeds the limit.'];
        }

        $newName = $file->getRandomName();
        $originalPath = $this->destination . $newName;
        $file->move($this->destination, $newName);
        //  Convert to WebP
        $webpName = pathinfo($newName, PATHINFO_FILENAME) . '.webp';
        $webpPath = $this->destination . $webpName;

        $converted = $this->convertToWebP($originalPath, $webpPath, 85);
        // Optional: remove original file
        if ($converted) {
            unlink($originalPath); // Delete original only if conversion is successful
            return [
                'status'     => true,
                'file_name'  => $webpName,
                'file_path'  => $webpPath
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Failed to convert image to WebP.'
            ];
        }
        return [
            'status'    => true,
            // 'file_name' => $newName,
            // 'file_path' => $this->destination . $newName,
            'file_name'  => $webpName,
            'file_path'  => $webpPath
        ];
    }
}
