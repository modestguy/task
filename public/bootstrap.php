<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as DbManager;

$dbManager = new DbManager();

$config = include '../env.php';
$connection = $config['connection'];

$dbManager->addConnection([
    'driver' => $connection['driver'],
    'host' => $connection['host'],
    'database' => $connection['database'],
    'username' => $connection['username'],
    'password' => $connection['password']
]);

$dbManager->setAsGlobal();
$dbManager->bootEloquent();

require '../config/routes.php';
