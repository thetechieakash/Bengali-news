<?php

namespace App\Helpers;

use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Files\FileSizeUnit;

class FileUploader
{
    protected array $allowedTypes = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/webp',
        'image/gif',
    ];

    protected int $maxSizeKB = 2048;
    protected string $destination;
    protected int $maxWidth = 1920;

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

    public function setMaxWidth(int $width): self
    {
        $this->maxWidth = $width;
        return $this;
    }

    public function upload(UploadedFile $file): array
    {
        return $this->processFile($file);
    }

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

    /* ---------------------------------------------------
     |  INTERNALS
     --------------------------------------------------- */

    protected function processFile(UploadedFile $file): array
    {
        if (!$file->isValid()) {
            return ['status' => false, 'message' => 'Invalid file'];
        }

        if (!in_array($file->getMimeType(), $this->allowedTypes, true)) {
            return ['status' => false, 'message' => 'File type not allowed'];
        }

        if ($file->getSizeByBinaryUnit(FileSizeUnit::KB) > $this->maxSizeKB) {
            return ['status' => false, 'message' => 'File size exceeds limit'];
        }

        $mime = $file->getMimeType();
        $tmpPath = $file->getTempName();

        /* ---------- GIF: STORE AS-IS ---------- */
        if ($mime === 'image/gif') {
            $name = pathinfo($file->getClientName(), PATHINFO_FILENAME);
            $newName = $name . '_' . time() . '.gif';
            $file->move($this->destination, $newName);

            return [
                'status'    => true,
                'file_name' => $newName,
                'file_path' => $this->destination . $newName,
                'type'      => 'gif'
            ];
        }

        /* ---------- IMAGE → WEBP ---------- */
        $webpName = pathinfo($file->getClientName(), PATHINFO_FILENAME)
            . '_' . time() . '.webp';

        $webpPath = $this->destination . $webpName;

        if (!$this->convertToWebP($tmpPath, $webpPath, 85)) {
            return ['status' => false, 'message' => 'Image conversion failed'];
        }

        return [
            'status'    => true,
            'file_name' => $webpName,
            'file_path' => $webpPath,
            'type'      => 'webp'
        ];
    }

    /* ---------- IMAGE HELPERS ---------- */

    protected function convertToWebP(string $source, string $dest, int $quality): bool
    {
        $info = getimagesize($source);
        if (!$info) {
            return false;
        }

        $image = match ($info['mime']) {
            'image/jpeg' => imagecreatefromjpeg($source),
            'image/png'  => imagecreatefrompng($source),
            'image/webp' => imagecreatefromwebp($source),
            default      => null,
        };

        if (!$image) {
            return false;
        }

        $image = $this->resizeIfNeeded($image);

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        $result = imagewebp($image, $dest, $quality);
        unset($image);

        return $result;
    }

    protected function resizeIfNeeded($image)
    {
        $width  = imagesx($image);
        $height = imagesy($image);

        if ($width <= $this->maxWidth) {
            return $image;
        }

        $newHeight = (int)(($this->maxWidth / $width) * $height);

        $resized = imagecreatetruecolor($this->maxWidth, $newHeight);

        imagealphablending($resized, false);
        imagesavealpha($resized, true);

        imagecopyresampled(
            $resized,
            $image,
            0,
            0,
            0,
            0,
            $this->maxWidth,
            $newHeight,
            $width,
            $height
        );

        unset($image);

        return $resized;
    }
}
