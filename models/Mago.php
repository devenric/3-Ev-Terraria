<?php
class Mago extends Terrarian{
    private $mana;
    function __construct($tag, $hp, $class,$mana, $id){
        parent::__construct($tag,$hp,$class,$id);
        $this->mana = $mana;
    }
    function getMana(){return $this->mana;}
}