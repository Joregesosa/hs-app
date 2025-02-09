<?php

use App\Config\DB;

require __DIR__ . "/migrations.php";
require "vendor/autoload.php";

DB::initialize();

$action = $argv[1] ?? "up";
$migration = $argv[2] ?? null;

if ($migration) {
    $migration = ucfirst($migration);
    if (isset($migrations[$migration])) {
        executeMigration($migrations[$migration], $action);
    } else {
        echo "Migration $migration not found. \n";
    }
} else {
    runMigrations($action);
}

function runMigrations($action)
{
    global $migrations;

    // if action is down, reverse the order of migrations
    if ($action === "down") {
        $migrations = array_reverse($migrations);
    }

    foreach ($migrations as $migration => $class) {
        executeMigration($class, $action);
    }
}

function executeMigration($migration, $action)
{
    switch ($action) {
        case "up":
            up($migration);
            break;
        case "down":
            down($migration);
            break;
        case "refresh":
            refresh($migration);
            break;
        default:
            echo "Invalid action";
    }
}

function up($migration)
{
    try {
        $migration::createTable();
        echo "Table created successfully \n";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function down($migration)
{
    try {
        $migration::dropTable();
        echo "Table dropped successfully \n";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function refresh($migration)
{
    try {
        $migration::dropTable();
        $migration::createTable();
        echo "Table refreshed successfully \n";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
