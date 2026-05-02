<?php
class Usuario{
    private $id;
    private $email;
    private $password;

    function __construct($email, $password, $id =0){
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }
    function getId(){return $this->id;}
    function getEmail(){return $this->email;}
    function getPassword(){return $this->password;}
}