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
            switch ($class) {
                case 'mago':
                    $terrarian = new Mago($tag, $hp, $class, $mana,0);
                    $this->gestor->crear($terrarian);
                    header("Location: index.php");
                    exit;
                    break;
                case 'melee':
                    $terrarian = new Melee($tag, $hp, $class, $blade,0);
                    $this->gestor->crear($terrarian);
                    header("Location: index.php");
                    exit;
                    break;
                case 'ranger':
                    $terrarian = new Ranger($tag, $hp, $class, $weapon,0);
                    $this->gestor->crear($terrarian);
                    header("Location: index.php");
                    exit;
                    break;
                case 'summoner':
                    $terrarian = new Summoner($tag, $hp, $class, $invocacion,0);
                    $this->gestor->crear($terrarian);
                    header("Location: index.php");
                    exit;
                    break;
                }
            }
            include "views/crear.php";
        }
    function editar(){
        $id = $_GET['id'] ?? null;
        $terrarian = $this->gestor->buscar($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tag = $_POST['tag'];
        $hp = $_POST['hp'];
        $class = $_POST['class'];
        $atributoClase = null;

        if ($class === 'Mago') {
            $atributoClase = $_POST['mana'];
        } elseif ($class === 'Melee') {
            $atributoClase = $_POST['blade'];
        } elseif ($class === 'Ranger') {
            $atributoClase = $_POST['weapon'];
        } elseif ($class === 'Summoner') {
            $atributoClase = $_POST['invocacion'];
        }
        $this->gestor->editar($id, $tag, $hp, $class, $atributoClase); //cuidado con el orden! recomiendo hacerlo de la forma más limpiecita
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