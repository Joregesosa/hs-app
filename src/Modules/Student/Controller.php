<?php

namespace App\Modules\Student;

use App\Modules\User\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Middlewares\RoleAccess;

class Controller
{
    public function index()
    {
        try {
            RoleAccess::notStudent();
            $query = Model::query();
            $query->where('role_id', 4);
            // ->where('status', 1);

            if (isset($_GET['s'])) {
                $query->whereHas('schools', function ($q) {
                    $q->where('id', $_GET['s']);
                });
            }

            $users = $query->get()->load('role');

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
            $user = Model::findOrFail($id)->load(['role', 'schools', 'services','student.country', 'student.controller', 'student.recruiter']);
            if($user->role->id != 4){
                throw new ModelNotFoundException('Student not Found');
            }
            header("HTTP/1.0 200 OK");
            echo json_encode($user);
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Not Found");
            echo json_encode('Student not Found');
        }catch (\Throwable $th) {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }

    }

 
}
