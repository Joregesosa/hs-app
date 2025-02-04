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

    
}
