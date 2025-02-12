<?php

namespace App\Modules\GoalCategory;

use App\Middlewares\RoleAccess;
use App\Modules\Category\Model;
use App\Utils\Validator;
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
}
