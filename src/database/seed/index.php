<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config\DB;

require  __DIR__ . "/factories.php";
require "vendor/autoload.php";

DB::initialize();

$action = $argv[1] ?? "seed";
$factory = $argv[2] ?? null;

if ($factory) {
    $factory = strtolower($factory);
    if (isset($factories[$factory])) {
        executeFactory($factories[$factory], $action, $factory);
    } else {
        echo "Factory $factory not found. \n";
    }
} else {
    runFactories($action);
}

function runFactories($action)
{
    global $factories;

    foreach ($factories as $table => $class) {
        executeFactory($class, $action, $table);
    }
}

function executeFactory($factory, $action, $table)
{
    switch ($action) {
        case "seed":
            seed($factory, $table);
            break;
        case "refresh":
            refresh($factory, $table);
            break;
        default:
            echo "Invalid action\n";
    }
}

function seed($factory, $table)
{
    try {
        $data = $factory::create();

        foreach ($data as $item) {
            Capsule::table($table)->insert($item);
        }
        echo "Data seeded successfully into $table \n";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function refresh($factory, $table)
{
    try {
        Capsule::table($table)->truncate();
        seed($factory, $table);
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
