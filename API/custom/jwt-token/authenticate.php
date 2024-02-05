<?php
require __DIR__ . '/vendor/autoload.php';
// Include the controller file and call the action
require_once '../controllers/UserController.php';
require_once '../models/Users.php';

use Firebase\JWT\JWT;

header('Content-Type: application/json');

// Create controller instance
$controllerInstance = new UserController();
$userModel = new User();
// Your secret key to encode/decode the token
$secret_key = $controllerInstance->getJWTSecretKey();
$payload = $userModel->getUser();

$jwt = JWT::encode($payload, $secret_key, 'HS256');
echo json_encode(array("token" => $jwt));
