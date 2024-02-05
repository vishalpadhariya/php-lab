<?php

// Include the controller file and call the action
require_once '../controllers/UserController.php';

// Create controller instance
$controllerInstance = new UserController();


// Protected resource
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.0 401 Unauthorized');
    echo json_encode(array("message" => "Unauthorized Access"));
    exit;
}

$postData = file_get_contents('php://input');

if ($postData === '') {
    header('HTTP/1.0 401 Unauthorized');
    echo json_encode(array("message" => "Unauthorized Access"));
    exit;
} else {
    // Decode the JSON data to a PHP array
    $data = json_decode($postData, true);

    if (empty($data)) {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array("message" => "Invalid Credentials"));
        exit;
    } else if (!key_exists("apikey", $data)) {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array("message" => "Invalid Credentials"));
        exit;
    } else {
        $apikey = $data['apikey'];
        if ($controllerInstance->validateAPIKey($apikey)) {
            $controllerInstance->getUser();
        }
    }
}
