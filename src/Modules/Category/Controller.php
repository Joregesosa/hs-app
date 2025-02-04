<?php

namespace App\Modules\Category;

use App\Middlewares\RoleAccess;
use App\Modules\Category\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Controller
{
    public function index()
    {
        try {
            $category = Model::all();
            header("HTTP/1.0 200 OK");
            echo json_encode($category);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $category = Model::findOrFail($id);
            header("HTTP/1.0 200 OK");
            echo json_encode($category);
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
            $category = Model::create($_POST);
            header("HTTP/1.0 201 Created");
            echo json_encode($category);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function update($id)
    {
        try {
            RoleAccess::admin();
            $category = Model::findOrFail($id);
            $category->update($_POST);
            header("HTTP/1.0 200 OK");
            echo json_encode($category);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            RoleAccess::admin();
            $category = Model::findOrFail($id);
            $category->delete();
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
