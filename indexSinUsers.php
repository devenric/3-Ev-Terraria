<?php
require_once "autoload.php";
session_start();
$gestor = new Gestor();
$controller = new ControllerCRUD($gestor);
// $usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
//     case 'login':
//         $usuarioController->login();
//         break;
//     case 'registro':
//         $usuarioController->registro();
//         break;
//     case 'logout':
//         $usuarioController->logout();
//         break;
//     case 'crear':
//     case 'editar':
//     case 'eliminar':
//     case 'borrarTodo':
//      if (!isset($_SESSION['usuarioId'])) {
//             header('Location: index.php?accion=login');
//             exit;
//         }

    case 'crear':
        $controller->crear();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    case 'borrarTodo':
        // ¡Ojo! La función borrarTodo() tampoco existe en ControllerCRUD.php
        if (method_exists($controller, 'borrarTodo')) {
            $controller->borrarTodo();
        }
        break;
    default:
        $controller->index();
        break;
}

