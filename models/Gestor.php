<?php
class Gestor{
    private $db;
    function __construct(){
        //pedimos la conexion a singleton
        $this->db = Connection::getInstance()->getConn();
    }
    function  listar(){
        $terrarians = [];
        $SQL = 'SELECT * from Terrariano';
        $resultado = $this->db->query($SQL);
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
            $SQL = 'INSERT INTO Terrariano (tag,hp, class, blade) VALUES (:tag, :hp, :class, :blade)';

        }elseif ($terrarian instanceof Ranger) {
            $SQL = 'INSERT INTO Terrariano (tag, hp, class, weapon) VALUES (:tag, :hp, :class, :weapon)';
        }
        elseif ($terrarian instanceof Summoner) {
            $SQL = 'INSERT INTO Terrariano (tag, hp, class, invocacion) VALUES (:tag, :hp, :class, :invocacion)';
        }
        $resultado = $this->db->prepare($SQL);
if (!$resultado) {
    // Error en la preparación
    $errorInfo = $this->db->errorInfo();
    throw new Exception("Error en preparación: " . $errorInfo[2]);
}

$resultado->bindValue(':tag', $terrarian->getTag());
$resultado->bindValue(':hp', $terrarian->getHP());
$resultado->bindValue(':class', $terrarian->getClass());

if ($terrarian instanceof Mago) {
    $resultado->bindValue(':mana', $terrarian->getMana());
} elseif ($terrarian instanceof Melee) {
    $resultado->bindValue(':blade', $terrarian->getBlade());
} elseif ($terrarian instanceof Ranger) {
    $resultado->bindValue(':weapon', $terrarian->getWeapon());
} elseif ($terrarian instanceof Summoner) {
    $resultado->bindValue(':invocacion', $terrarian->getInvocacion());
}
$resultado->execute();

return true;
    }
    function buscar($id){
        try{
            $SQL = "SELECT * FROM Terrariano where id = :id";
            $resultado = $this->db->prepare($SQL);
            $resultado->bindValue(":id", $id);
            $resultado->execute();
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
            return $terrarian;
            }
            }catch(PDOException $e){
                echo "ID no encontrado " . $e->getMessage();
            }

        
    }
    function editar($id, $tag, $hp, $class, $atributoClase){
        try{
            $SQL = "";
        // [PROFESOR] 1. VERSIÓN SIMPLE: Escribimos el UPDATE a mano para cada caso.
        // Fíjate que en todos usamos el mismo comodín ":extra" para el dato final.
        if ($class === 'Mago') {
            $SQL = "UPDATE Terrariano SET tag = :tag, hp = :hp, class = :class, mana = :atributoClase WHERE id = :id";
        
        } elseif ($class === 'Melee') {
            $SQL = "UPDATE Terrariano SET tag = :tag, hp = :hp, class = :class, blade = :atributoClase WHERE id = :id";
        
        } elseif ($class === 'Ranger') {
            $SQL = "UPDATE Terrariano SET tag = :tag, hp = :hp, class = :class, weapon = :atributoClase WHERE id = :id";
        
        } elseif ($class === 'Summoner') {
            $SQL = "UPDATE Terrariano SET tag = :tag, hp = :hp, class = :class, invocacion = :atributoClase WHERE id = :id";
        }

        if (empty($SQL)) {
                return false;
            }
        // [PROFESOR] 2. Preparamos la consulta que haya salido elegida del 'if'
        $resultado = $this->conexion->prepare($SQL); 
        
        // [PROFESOR] 3. Bindeamos los datos. 
        // Como a todas las consultas les pusimos ":extra" al final, solo tenemos que bindearlo una vez aquí abajo.
        $resultado->bindValue(":id", (int)$id); 
        $resultado->bindValue(":tag", $tag);
        $resultado->bindValue(":hp", $hp);
        $resultado->bindValue(":class", $class);
        $resultado->bindValue(":atributoClase", $atributoClase);

        // [PROFESOR] 4. Ejecutamos
        $resultado->execute();
        return true;

    } catch(PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
        return false;
    }

    }
function eliminar($id){
    //try-catch, siempre que toquemos la BD.
    try {
        $SQL = "DELETE FROM Terrariano WHERE id = :id";
        
        $resultado = $this->db->prepare($SQL);
        //forzamos que el ID se trate como un número entero (int)
        $resultado->bindValue(":id", (int)$id);
        
        return $resultado->execute();

    } catch (PDOException $e) {
        echo("Error al eliminar: " . $e->getMessage());
        return false;
    }
}
    function registrarUsuario(Usuario $usuario){
        
        $sql = "INSERT INTO Usuario(email, password) VALUES (:email, :password)";
        $resultado = $this->db->prepare($sql);

        $resultado->bindValue(':email', $usuario->getEmail());
        $resultado->bindValue(':password', $usuario->getPassword());
        return $resultado->execute();
        
    }
    function buscarUsuarioPorEmail($email){
        $sql = "SELECT * from Usuario where email = :email limit 1";
        $resultado = $this->db->prepare($sql);

        $resultado->bindValue(':email', $email);
        $resultado->execute();
        $value = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($value) {
            return new Usuario($value['email'], $value['password'], $value['id']);
        }
        return false;
    }
}