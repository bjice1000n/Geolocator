<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// PHP v7.4
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Access-Control-Request-Method, Access-Control-Request-Headers");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Content-Type, Accept, Access-Control-Request-Method, Access-Control-Request-Headers");
    header("HTTP/1.1 200 OK");
    die();
}

include 'Autoloader.php';
include 'routes.php';
