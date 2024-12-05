<?php
require 'controllers/EgresadoController.php';

// Simple router
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'egresado';
    $action = 'index';
}

// Instantiate the appropriate controller
switch ($controller) {
    case 'egresado':
        $controller = new EgresadoController();
        break;
    // Add more cases for other controllers if needed
}

// Call the appropriate action
$controller->{$action}();
?>
