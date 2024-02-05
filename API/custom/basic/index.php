<?php

require_once '../config.php';

// Include the controller file and call the action
require_once '../controllers/UserController.php';

// Create controller instance
$controllerInstance = new UserController();

$controllerInstance->getUser();
