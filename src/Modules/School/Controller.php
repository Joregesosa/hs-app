<?php

namespace App\Modules\School;

use App\Middlewares\RoleAccess;
use App\Modules\School\Model;
use App\Utils\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Controller
{
    public function index()
    {
        try {
            $school = Model::all();
            header("HTTP/1.0 200 OK");
            echo json_encode($school);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $school = Model::findOrFail($id);
            header("HTTP/1.0 200 OK");
            echo json_encode($school);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Not Found");
            echo json_encode($th->getMessage());
        }
    }

    public function store()
    {
        try {
            RoleAccess::admin();
            $school = Model::create($_POST);
            $required = ['name'];
            Validator::required($_POST, $required);
            header("HTTP/1.0 201 Created");
            echo json_encode(['status' => 'success', 'message' => 'School created successfully']);
        } catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function update($id)
    {
        try {
            RoleAccess::admin();
            $school = Model::findOrFail($id);
            $school->update($_POST);
            header("HTTP/1.0 200 OK");
            echo json_encode(['status' => 'success', 'message' => 'School updated successfully']);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            RoleAccess::admin();
            $school = Model::findOrFail($id);
            $school->delete();
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
