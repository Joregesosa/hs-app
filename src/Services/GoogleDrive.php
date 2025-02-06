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
            $this->client->setAuthConfig($root . '/apikey.json');;
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
                'parents' => array('1A4pgn3RfoG1sJtrZFG83FP1jXtDV6O5y')
            ));
            $content = file_get_contents($file_path);

            $file = $this->driveService->files->create($fileMetadata, array(
                'data' => $content,
                'mimeType' => $file_type,
                'uploadType' => 'multipart',
                'fields' => 'id',
            ));
            printf("File ID: %s\n", $file->id);
            return $file->id;
        } catch (\Google\Exception $e) {
            echo "Error Message: " . $e;
        }
    }
}
