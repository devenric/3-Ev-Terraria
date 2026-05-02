<?php
require_once "autoload.php";
session_start();
$gestor = new Gestor();
$controller = new ControllerCRUD($gestor);
$usuarioController = new ControllerUsuario($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'login':
        $usuarioController->login();
        break;
    case 'registro':
        $usuarioController->registro();
        break;
    case 'logout':
        $usuarioController->logout();
        break;
    case 'crear':
    case 'editar':
    case 'eliminar':
     if (!isset($_SESSION['usuarioID'])) {
            header('Location: index.php?accion=login');
            exit;
        }
        if ($accion === 'crear') $controller->crear();
        if ($accion === 'editar') $controller->editar();
        if ($accion === 'eliminar') $controller->eliminar();
        break;
    default:
    $controller->index();
}