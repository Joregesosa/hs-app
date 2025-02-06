<?php

namespace App\Utils;

class Validator {

    
    static function required($data, $fields)
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