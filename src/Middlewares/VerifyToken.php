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
            echo json_encode(['error' => 'Token not provided']);
            exit();
        }

        $token = $_COOKIE['token'];

        if (empty($_ENV['JWT_SECRET'])) {
            http_response_code(500);
            echo json_encode(['error' => 'JWT secret not set']);
            exit();
        }

        try {
            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
            $_REQUEST['auth'] = (array) $decoded;
        } catch (\Firebase\JWT\ExpiredException $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Token has expired']);
            exit();
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid token signature']);
            exit();
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid token']);
            exit();
        }
    }
}
