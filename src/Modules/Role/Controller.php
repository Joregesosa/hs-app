<?php

namespace App\Modules\Role;

use App\Modules\Role\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Controller
{

    public function index()
    {
        try {
            $roles = Model::all();
            header("HTTP/1.0 200 OK");
            echo json_encode($roles);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $role = Model::findOrFail($id);
            header("HTTP/1.0 200 OK");
            echo json_encode($role);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Not Found");
            echo json_encode($th->getMessage());
        }
    }

    public function store()
    {
        try {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = Model::create($_POST);
            header("HTTP/1.0 201 Created");
            echo json_encode($role);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function update($id)
    {
        try {
            $role = Model::findOrFail($id);
            $role->update($_POST);
            header("HTTP/1.0 200 OK");
            echo json_encode($role);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $role = Model::findOrFail($id);
            $role->delete();
            echo json_encode(['status' => 'success', 'message' => 'role deleted successfully']);
        } catch (ModelNotFoundException $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
