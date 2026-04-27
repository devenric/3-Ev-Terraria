<?php
class Ranger extends Terrarian{
    private $weapon;
    function __construct($tag, $hp, $class,$weapon,$id){
        parent::__construct($tag, $hp, $class,$id);
            $this->weapon = $weapon;
        }
        function getWeapon(){return $this->weapon;}
}