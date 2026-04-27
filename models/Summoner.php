<?php
class Summoner extends Terrarian{
    private $invocacion;
    function __construct($tag, $hp, $class,$invocacion,$id){
        parent::__construct($tag, $hp, $class,$id);
        $this->invocacion = $invocacion;
    }
    function getInvocacion(){return $this->invocacion;}
}