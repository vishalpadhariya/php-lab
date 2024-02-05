<?php

require __DIR__ . '/vendor/autoload.php';
// Include the controller file and call the action
require_once '../controllers/UserController.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Create controller instance
$controllerInstance = new UserController();

// Protected resource
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.0 401 Unauthorized');
    echo json_encode(array("message" => "Unauthorized Access"));
    exit;
}

// Check if the Authorization header with Bearer token is provided
$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo json_encode(array("message" => "Authorization header is missing"));
    exit;
} else {
    $token = $headers['Authorization'];
    try {
        $sKey = new key($controllerInstance->getJWTSecretKey(), 'HS256');
        $stdClass = new stdClass();
        $validateData = JWT::decode($token, $sKey, $stdClass);
        if ($validateData) {
            header('Content-Type: application/json');
            // Valid JWT token
            echo json_encode($validateData);
        }
    } catch (\Throwable $th) {
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode(array("message" => "Unauthorized Access! Please provide valid token"));
        exit;
    }
}
