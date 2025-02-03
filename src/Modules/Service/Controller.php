<?php

namespace App\Modules\Service;

use App\Modules\Service\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Controller
{
    public function index()
    {
        try {
            $service = Model::all()->load('category', 'user', 'reviewer');
            header("HTTP/1.0 200 OK");
            echo json_encode($service);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $service = Model::findOrFail($id);
            $service->load('category', 'user', 'reviewer');
            header("HTTP/1.0 200 OK");
            echo json_encode($service);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Not Found");
            echo json_encode($th->getMessage());
        }
    }

    public function store()
    {
        try {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $service = Model::create($_POST);
            header("HTTP/1.0 201 Created");
            echo json_encode($service);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function update($id)
    {
        try {
            $service = Model::findOrFail($id);
            $service->update($_POST);
            header("HTTP/1.0 200 OK");
            echo json_encode($service);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $service = Model::findOrFail($id);
            $service->delete();
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
