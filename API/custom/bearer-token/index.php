<?php

// Include the controller file and call the action
require_once '../controllers/UserController.php';

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
    $authorizationHeader = $headers['Authorization'];
    $token = str_replace('Bearer ', '', $authorizationHeader); // Extract token from the header
    $controllerInstance->validateBearerToken($token);
}
