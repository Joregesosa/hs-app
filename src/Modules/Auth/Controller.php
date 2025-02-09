<?php

namespace App\Modules\Auth;

use App\Modules\User\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Firebase\JWT\JWT;

class Controller
{
    public function login()
    {

        try {

            $user = Model::where('email', $_POST['email'])->first();
            if (!$user) {
                header("HTTP/1.0 401 Unauthorized");
                echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
                return;
            }
            $user->load('role');
            if ($user && password_verify($_POST['password'], $user->password)) {
                $key = $_ENV['JWT_SECRET'];

                $payload = [
                    'iss' => 'http://localhost',
                    'user' => $user->id,
                    'role' => $user->role,
                    'iat' => time(),
                    'exp' => time() + 60 * 60
                ];

                $jwt = JWT::encode($payload, $key, 'HS256');

                header("HTTP/1.0 200 OK");
                setcookie('token', $jwt, $payload['exp'], '/', '', false, true);
                echo json_encode(['message' => 'Login successful']);
            } else {
                header("HTTP/1.0 401 Unauthorized");
                echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
            }
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function logout()
    {
        setcookie('token', '', time() - 3600, '/', '', false, true);
        header("HTTP/1.0 200 OK");
        echo json_encode(['message' => 'Logout successful']);
    }
}
