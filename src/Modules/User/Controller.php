<?php

namespace App\Modules\User;

use App\Modules\User\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Middlewares\RoleAccess;

class Controller
{
    public function index()
    {
        try {
            RoleAccess::admin();
            $users = Model::all()->load('role');
            header("HTTP/1.0 200 OK");
            echo json_encode($users);

        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            RoleAccess::adminOrOwner($id);
            $user = Model::findOrFail($id)->load(['role', 'schools']);
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
            RoleAccess::admin();
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
            RoleAccess::adminOrOwner($id);
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
            RoleAccess::admin();
            $user = Model::findOrFail($id);
            $user->delete();
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
