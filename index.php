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
        case ($accion === 'crear') :$controller->crear();
        case ($accion === 'editar') :$controller->editar();
        case ($accion === 'eliminar') :$controller->eliminar();
        case ($accion === 'borrarTodo') :$controller->borrarTodo();
        break;
    default:
    $controller->index();
}
