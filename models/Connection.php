<?php
class Connection{
    private static $instance = null; // paso 1: guardar instancia unica de la clase
    private $archivo = "config.json";
    private function __construct(){
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
        
        $this->db = new PDO($dsn,$user,$pass);}
        catch(PDOException $e){
            echo "<b>Mensaje:</b>" . $e->getMessage() . "<br>";
            echo "<b>Codigo de error MySQL:</b>" . $e->getCode() . "<br>";
            }
            catch(Exception $e){
                echo "Error del sistema" . $e->getMessage();
                }
                return $this->db;
                }
                static function getInstance(){
                    if (self::$instance === null) {
                        self::$instance = new self(); // si nadie se ha conectado, crea una nueva instancia
                    }
                    return self::$instance;
                }
function getConn(){return $this->db;}

private function __clone(){}
function __destruct(){$this->db = null;}
}