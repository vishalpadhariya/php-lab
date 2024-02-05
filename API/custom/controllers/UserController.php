<?php
require_once '../models/Users.php';
require_once '../config.php';

class UserController
{
    public function getUser()
    {
        header('Content-Type: application/json');
        $userModel = new User();
        $userData = $userModel->getUser();
        if ($userData) {
            // Assuming JSON output for an API
            echo json_encode($userData);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Something went wrong!"));
        }
    }

    public function basicAuthentication($username = "", $password = "")
    {

        if ($username === USERNAME && $password === PASSWORD) {
            $this->getUser();
        } else {
            http_response_code(401);
            echo json_encode(array("message" => "Unauthorized Access: Invalidate Credentials!"));
            exit;
        }
    }

    public function validateAPIKey($apiKey)
    {
        if ($apiKey !== "" && $apiKey === API_KEY) {
            $this->getUser();
        } else {
            http_response_code(401);
            echo json_encode(array("message" => "Unauthorized Access: Invalidate Credentials!"));
            exit;
        }
    }

    public function validateBearerToken($token)
    {
        $validBearerToken = BEARER_TOKEN_ACCESS_KEY . "." . BEARER_TOKEN_SECRET_KEY;
        if ($token === $validBearerToken) {
            // Valid Bearer token
            $this->getUser();
        } else {
            // Invalid Bearer token
            http_response_code(401);
            echo json_encode(array("message" => "Invalid Bearer token"));
            exit;
        }
    }

    public function getJWTSecretKey()
    {
        return JWT_SECRET;
    }
}
