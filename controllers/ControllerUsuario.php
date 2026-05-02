<?php
class ControllerUsuario{
    private $gestor;

    function __construct($gestor){
        $this->gestor = $gestor;
    }

    function registro(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passwordPlana = $_POST['password'];
            $passwordHash = password_hash($passwordPlana, PASSWORD_DEFAULT);
            $user = new Usuario($email, $passwordHash);
            $this->gestor->registrarUsuario($user);
            header("Location: index.php?accion=login");
            exit;
        }
        include "views/register.php";
    }
    function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passwordPlana = $_POST['password'];
            $user = $this->gestor->buscarUsuarioPorEmail($email);
            if ($user && password_verify($passwordPlana, $user->getPassword())) {
                $_SESSION['usuarioID'] = $user->getId();
                $_SESSION['usuarioEmail'] = $user->getEmail();
                header("Location: index.php");
                exit;
            }else {
                $error = "Credenciales Incorrectas";
                }
        }
        include "views/login.php";
    }
function logout(){
        $_SESSION = [];
        session_destroy();

        header("Location: index.php?accion=login");
        exit;
    }
    }