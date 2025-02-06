<?php

namespace App\Modules\Service;

use App\Middlewares\RoleAccess;
use App\Modules\Service\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\FileUpload;
use App\Services\GoogleDrive;

class Controller
{
    public function index()
    {
        try {
            $role = ((array) $_REQUEST['auth']['role'])['name'];
            $user =  intval($_REQUEST['auth']['user']);

            $status = $_GET['status'] ?? null;
            $user_id = $_GET['user'] ?? null;

            $query = Model::query();

            if ($role === 'Student') {
                $query->where('user_id', $user);
            } elseif ($user_id) {
                $query->where('user_id', $user_id);
            }

            if ($status !== null) {
                $query->where('status', $status);
            }

            $service = $query->get()->load(['category', 'user', 'reviewer']);

            header("HTTP/1.0 200 OK");
            echo json_encode($service);
            return;
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

            //verify ownership or admin
            RoleAccess::adminOrOwner($service->user->id);

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
            RoleAccess::student($_REQUEST['auth']['role']);
            $data = $_POST;
            $data['user_id'] = $_REQUEST['auth']['user'];
            if (!isset($_FILES['evidence'])) {
                header("HTTP/1.0 400 Bad Request");
                echo json_encode(['status' => 'error', 'message' => 'evidence is required']);
                exit();
            }

            $file_id = FileUpload::upload($_FILES['evidence']);
            $data['evidence'] = $file_id;
            $required = ['category_id', 'description', 'amount_reported'];
            $this->required($data, $required);

            $service = Model::create($data);

            header("HTTP/1.0 201 Created");
            echo json_encode(['status' => 'success', 'message' => 'Service created successfully']);

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

    public function evidence($id)
    {
        try {
            $service = Model::findOrFail($id);
            $googleDrive = new GoogleDrive();
            $file = $googleDrive->download($service->evidence);
            header("HTTP/1.0 200 OK");
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline;');
            echo $file;
        } catch (ModelNotFoundException $th) {
            header("HTTP/1.0 404 Not Found");
            echo json_encode($th->getMessage());
        }
    }

    function required($data, $fields)
    {
        $missing = [];
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                $missing[] = $field;
            }
        }
        if ($missing) {
            $string = implode(', ', $missing);
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(['status' => 'error', 'message' => "fields  $string are required"]);
            exit();
        }
    }
}
