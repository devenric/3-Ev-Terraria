<?php
class Connection{
        private $archivo = "config.json";
    protected $conexion;
    function __construct(){
        $this->makeConnection();
    }
    function makeConnection(){
        try{
            if(!file_exists($this->archivo)){
                throw new Exception("Archivo de configuración no encontrado");
            }
        $jsonConfig = file_get_contents($this->archivo);
        $array = json_decode($jsonConfig, true);
    
    $host = $array['host'];
    $db = $array['db'];
    $user = $array['username'];
    $pass = $array['password'];
    $dsn ="mysql:host=$host;dbname=$db";

    $this->conexion = new PDO($dsn,$user,$pass);}
    catch(PDOException $e){
        echo "<b>Mensaje:</b>" . $e->getMessage() . "<br>";
        echo "<b>Codigo de error MySQL:</b>" . $e->getCode() . "<br>";
    }
    catch(Exception $e){
        echo "Error del sistema" . $e->getMessage();
    }
    return $this->conexion;
    }
function getConn(){return $this->conexion;}

function __destruct(){$this->conexion = null;}
}