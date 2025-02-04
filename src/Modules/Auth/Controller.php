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

    public function show($id)
    {
        try {
            $user = Model::findOrFail($id)->load(['role', 'schools' => function ($query) {
                $query->without('pivot');
            }]);
            header("HTTP/1.0 200 OK");
            echo json_encode($user);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Not Found");
            echo json_encode($th->getMessage());
        }
    }

    public function store()
    {
        try {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user = Model::create($_POST);
            header("HTTP/1.0 201 Created");
            echo json_encode($user);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function update($id)
    {
        try {
            $user = Model::findOrFail($id);
            $user->update($_POST);
            header("HTTP/1.0 200 OK");
            echo json_encode($user);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = Model::findOrFail($id);
            $user->delete();
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
