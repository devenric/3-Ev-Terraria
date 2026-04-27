<?php
class Gestor extends Connection{
    function __construct(){
        parent::__construct();
    }
    function  listar(){
        $terrarians = [];
        $SQL = 'SELECT * from Terrariano';
        $resultado = $this->conexion->query($SQL);
        while ($value = $resultado->fetch(PDO::FETCH_ASSOC)) {
    if ($value['class'] === 'Mago') {
        $terrarian = new Mago($value['tag'], $value['hp'], $value['class'], $value['mana'], $value['id']);
    } elseif ($value['class'] === 'Melee') {
        $terrarian = new Melee($value['tag'], $value['hp'], $value['class'], $value['blade'], $value['id']);
    } elseif ($value['class'] === 'Ranger') {
        $terrarian = new Ranger($value['tag'], $value['hp'], $value['class'], $value['weapon'], $value['id']);
    } elseif ($value['class'] === 'Summoner') {
        $terrarian = new Summoner($value['tag'], $value['hp'], $value['class'], $value['invocacion'], $value['id']);
    }
    $terrarians[] = $terrarian;
}
        return $terrarians;
    }
    function crear($terrarian){
        if ($terrarian instanceof Mago) {
    $SQL = 'INSERT INTO Terrariano (tag, hp, class, mana) VALUES (:tag, :hp, :class, :mana)';
        }elseif ($terrarian instanceof Melee) {
            $SQL = 'INSERT INTO Terrariano (tag,hp, class, blade) VALUES :tag, :hp, :class, :blade';

        }elseif ($terrarian instanceof Ranger) {
            $SQL = 'INSERT INTO Terrariano (tag, hp, class, weapon) VALUES :tag, :hp, :class, :weapon';
        }
        elseif ($terrarian instanceof Summoner) {
            $SQL = 'INSERT INTO Terrariano (tag, hp, class, invocacion) VALUES (:tag, :hp, :class, :invocacion)';
        }
        $resultado = $this->conexion->prepare($SQL);
        $resultado->bindValue(':tag', $terrarian->getTag());
        $resultado->bindValue(':hp', $terrarian->getHP());
        $resultado->bindValue(':class', $terrarian->getClass());
        if ($terrarian instanceof Mago) {
        $resultado->bindValue(':mana', $terrarian->getMana());
        }
        elseif ($terrarian instanceof Melee) {
        $resultado->bindValue(':blade', $terrarian->getBlade());
        }elseif ($terrarian instanceof Ranger) {
        $resultado->bindValue(':weapon', $terrarian->getWeapon());
        }elseif ($terrarian instanceof Summoner) {
        $resultado->bindValue(':invocacion', $terrarian->getInvocacion());
        }
        return $resultado->execute();
    }
    function buscar(){

    }
    function eliminar($id){
$query = "DELETE from Terrariano where $id = :id";
$resultado = $this->conexion->prepare($query);
$resultado->bindValue(":id", $id);
return $resultado->execute();
}
}