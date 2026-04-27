<?php
class ControllerCRUD{
    private $gestor;

    function __construct($gestor){
        $this->gestor = $gestor;
    }
    function index(){
        $terrarians = $this->gestor->listar();
        include "views/listar.php";
    }
    function crear(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = uniqid();
            $tag = $_POST['tag'];
            $hp = $_POST['hp'];
            $class = $_POST['class'];
            $mana = $_POST['mana'];
            $blade = $_POST['blade'];
            $weapon = $_POST['weapon'];
            $invocacion = $_POST['invocacion'];
            if ($mana !== null) {
                $terrarian = new Mago($tag, $hp, $class, $mana,0);
            }elseif ($blade !== null) {
                $terrarian = new Melee($tag, $hp, $class, $blade,0);
            }elseif ($weapon !== null) {
                $terrarian = new Ranger($tag, $hp, $class, $weapon,0);
            }
            elseif ($invocacion !== null) {
                $terrarian = new Summoner($tag, $hp, $class, $invocacion,0);
            }
            $this->gestor->crear($terrarian);
            header("Location: index.php");
            exit;
        }
        include "views/crear.php";
    }
    function editar(){
        $id = $_POST['id'] ?? null;
        $terrarian = $this->gestor->buscar($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['mana'] !== null) {
                $terrarian = $this->gestor->editar($_POST['tag'],$_POST['hp'], $_POST['class'], $_POST['mana']);
            }elseif ($_POST['blade'] !== null) {
                $terrarian = $this->gestor->editar($_POST['tag'],$_POST['hp'], $_POST['class'], $_POST['blade']);
            }
            elseif ($_POST['weapon'] !== null) {
                $terrarian = $this->gestor->editar($_POST['tag'],$_POST['hp'], $_POST['class'], $_POST['weapon']);
            }
            elseif ($_POST['invocacion'] !== null) {
                $terrarian = $this->gestor->editar($_POST['tag'],$_POST['hp'], $_POST['class'], $_POST['invocacion']);
            }
            header("Location: index.php");
            exit;
        }
        include "views/editar.php";
    }
    function eliminar(){
        $id = $_GET['id'] ?? null; //seleccionar mediante identificacion
        $this->gestor->eliminar($id);//ejecutar método CRUD
        header("Location: index.php");
        exit;
    }
}