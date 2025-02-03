<?php

namespace App\Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class VerifyToken
{
    public static function handle()
    {
        if (!isset($_COOKIE['token'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Token cookie not found']);
            exit();
        }

        $token = $_COOKIE['token'];

        try {
            $decoded = JWT::decode($token, new Key('your-secret-key', 'HS256'));
            // Store the decoded token in the global $_REQUEST array
            $_REQUEST['decoded_token'] = (array) $decoded;
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid token']);
            exit();
        }
    }
}