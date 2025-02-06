<?php

namespace App\Services;

use App\Services\GoogleDrive;

class FileUpload
{
    public static function upload($file, $path)
    {
        try {
            // Check for upload errors
            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new \Exception('File upload error. Code: ' . $file['error']);
            }

            // Check file size (e.g., max 5MB)
            $maxFileSize = 5 * 1024 * 1024; // 5MB
            if ($file['size'] > $maxFileSize) {
                throw new \Exception('File size exceeds the maximum limit of 5MB.');
            }
            // Check file type
            if ($file['type'] !== 'application/pdf') {
                throw new \Exception('Invalid file type. Only PDF files are allowed.');
            }

            // Extract file extension
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

            // Generate file name using time() and extracted extension
            $file_name = time() . '.' . $fileExtension;
 
            $googleDrive = new GoogleDrive();
            $id =  $googleDrive->upload($file['tmp_name'], $file_name, $file['type']);
            return $id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
