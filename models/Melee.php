<?php
class Melee extends Terrarian{
    private $blade;
    function __construct($tag, $hp, $class,$blade,$id){
        parent::__construct($tag,$hp,$class,$id);
        $this->blade = $blade;
    }
    function getBlade(){return $this->blade;}
}