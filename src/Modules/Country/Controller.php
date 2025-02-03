<?php

namespace App\Modules\Country;

use App\Modules\Country\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Controller
{
    public function index()
    {
        try {
            $country = Model::all();
            header("HTTP/1.0 200 OK");
            echo json_encode($country);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $country = Model::findOrFail($id);
            header("HTTP/1.0 200 OK");
            echo json_encode($country);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Not Found");
            echo json_encode($th->getMessage());
        }
    }

    public function store()
    {
        try {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $country = Model::create($_POST);
            header("HTTP/1.0 201 Created");
            echo json_encode($country);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function update($id)
    {
        try {
            $country = Model::findOrFail($id);
            $country->update($_POST);
            header("HTTP/1.0 200 OK");
            echo json_encode($country);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $country = Model::findOrFail($id);
            $country->delete();
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
