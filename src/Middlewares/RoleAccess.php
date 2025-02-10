<?php

namespace App\Middlewares;

class RoleAccess
{
    public static function admin()
    {
        $role = (array) $_REQUEST['auth']['role'];

        if ($role['name'] !== 'Admin') {
            header("HTTP/1.0 403 Forbidden");
            echo json_encode([
                'status' => 'error',
                'message' => 'You do not have permission to access this resource'
            ]);
            exit();
        }
    }

    public static function adminOrOwner($id)
    {
        $role = (array) $_REQUEST['auth']['role'];
        $user =  intval($_REQUEST['auth']['user']);

        if ($role['name'] !== 'Admin' && $user !== intval($id)) {
            header("HTTP/1.0 403 Forbidden");
            echo json_encode([
                'status' => 'error',
                'message' => 'You do not have permission to access this resource'
            ]);
            exit();
        }
    }

    public static function adminOrStudent()
    {
        $role = (array) $_REQUEST['auth']['role'];
        $user =  intval($_REQUEST['auth']['user']);

        if ($role['name'] !== 'Admin' && $role['name'] !== 'Student') {
            header("HTTP/1.0 403 Forbidden");
            echo json_encode([
                'status' => 'error',
                'message' => 'You do not have permission to access this resource'
            ]);
            exit();
        }
    }

    public static function student()
    {
        $role = (array) $_REQUEST['auth']['role'];
        if ($role['name'] !== 'Student') {
            header("HTTP/1.0 403 Forbidden");
            echo json_encode([
                'status' => 'error',
                'message' => 'You do not have permission to access this resource'
            ]);
            exit();
        }
    }

    public static function notStudent()
    {
        $role = ((array) $_REQUEST['auth']['role'])['name'];

        if ($role === 'Student') {
            header("HTTP/1.0 403 Forbidden");
            echo json_encode([
                'status' => 'error',
                'message' => 'You do not have permission to access this resource'
            ]);
            exit();
        }
    }
}
