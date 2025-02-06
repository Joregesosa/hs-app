<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;

class GoogleDrive
{
    private $client;
    private $driveService;

    public function __construct()
    {
        try {
            $this->client = new Client();
            $root = $_SERVER['DOCUMENT_ROOT'];
            $this->client->setAuthConfig($root . '/apikey.json');
            $this->client->addScope(Drive::DRIVE_FILE);
            $this->driveService = new Drive($this->client);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function upload($file_path, $file_name, $file_type)
    {
        try {

            $fileMetadata = new Drive\DriveFile(array(
                'name' => $file_name,
                'parents' => array($_ENV['GOOGLE_DRIVE_FOLDER_ID'])
            ));
            $content = file_get_contents($file_path);

            $file = $this->driveService->files->create($fileMetadata, array(
                'data' => $content,
                'mimeType' => $file_type,
                'uploadType' => 'multipart',
                'fields' => 'id',
            ));
            return $file->id;
        } catch (\Google\Exception $e) {
            echo "Error Message: " . $e;
        }
    }

    function download($file_id)
    {
        try {

            $response = $this->driveService->files->get($file_id, array(
                'alt' => 'media'
            ));
            $content = $response->getBody()->getContents();
            return $content;
        } catch (\Google\Exception $e) {
            echo "Error Message: " . $e;
        }
    }

    function delete($file_id)
    {
        try {
            $this->driveService->files->delete($file_id);
            return true;
        } catch (\Google\Exception $e) {
            echo "Error Message: " . $e;
        }
    }
}
