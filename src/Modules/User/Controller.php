<?php

namespace App\Modules\User;

use App\Modules\User\Model;
use App\Modules\Student\Model as Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Middlewares\RoleAccess;
use App\Utils\Validator;

class Controller
{
    public function index()
    {
        try {
            RoleAccess::adminOrStudent();
            $role = (array) $_REQUEST['auth']['role']; 

            if($role['name'] === 'Student' && !isset($_GET['r'])){
                header("HTTP/1.0 400 Bad Request");
                echo json_encode(['status' => 'error', 'message' => 'Role is required', 'options' => ['r' => '2 or 3']]);
                return;
            }


            if(isset($_GET['r']) && ($_GET['r'] === '2' || $_GET['r'] === '3')){
                $users = Model::where('role_id', $_GET['r'])->get()->load('role');
                header("HTTP/1.0 200 OK");
                echo json_encode($users);
                return;
            }
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
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
    }

    public function store()
    {
        try {
            // begin transaction
            Model::getConnectionResolver()->connection()->beginTransaction();
            RoleAccess::admin();

            $required = ['f_name', 'f_lastname', 'email', 'password', 'role_id', 'schools'];
            if ($_POST['role_id'] === 4) {
                $required[] = 'controller_id';
                $required[] = 'recruiter_id';
                $required[] = 'country_id';
            }

            Validator::required($_POST, $required);
            $this->create_user_validation();

            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user = Model::create($_POST);
            $user->schools()->attach($_POST['schools']);
            if ($_POST['role_id'] === 4) {
                Student::create([
                    'user_id' => $user->id,
                    'controller_id' => $_POST['controller_id'],
                    'recruiter_id' => $_POST['recruiter_id'],
                    'country_id' => $_POST['country_id'],
                ]);
            }

            Model::getConnectionResolver()->connection()->commit();
            header("HTTP/1.0 201 Created");
            echo json_encode(['status' => 'success', 'message' => 'User created successfully']);
        } catch (\Throwable $th) {
            Model::getConnectionResolver()->connection()->rollBack();
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
            $user->save();
            header("HTTP/1.0 200 OK");
            echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
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
            $user->status = 0;
            $user->save();
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public  function create_user_validation()
    {
        if (Model::where('email', $_POST['email'])->exists()) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
            exit;
        }

        if (!is_array($_POST['schools'])) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(['status' => 'error', 'message' => 'Schools must be an array']);
            exit;
        }

        if ($_POST['role_id'] !== 1 && count($_POST['schools']) < 1) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(['status' => 'error', 'message' => 'At least one school is required']);
            exit;
        }

        if ($_POST['role_id'] === 1 && count($_POST['schools']) > 0) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(['status' => 'error', 'message' => 'Admins cannot be assigned to schools']);
            exit;
        }

        if ($_POST['role_id'] === 4 && count($_POST['schools']) > 1) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(['status' => 'error', 'message' => 'Students can only be assigned to one school']);
            exit;
        }
    }
}
