<?php
class Terrarian{
    protected $id;
    protected $tag;
    protected $hp;
    protected $class;
    function __construct($tag, $hp, $class,$id = 0){
        $this->id = $id;
        $this->tag = $tag;
        $this->hp = $hp;
        $this->class = $class;
    }
    function getId(){return $this->id;}
    function getTag(){return $this->tag;}
    function getHP(){return $this->hp;}
    function getClass(){return $this->class;}
}