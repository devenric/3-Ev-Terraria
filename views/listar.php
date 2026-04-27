    <!DOCTYPE html>
    <html>
    <head>
    <title>TerraCRUD</title>
    </head>
    <body>
    <div style="background-color: #f0f0f0; padding: 10px; margin-bottom: 20px;">
        <?php if (isset($_SESSION['usuarioId'])): ?>
            Bienvenido, <b><?= $_SESSION['usuarioEmail'] ?></b> |
            <a href="index.php?accion=logout">Cerrar Sesión</a>
        <?php else: ?>
            <a href="index.php?accion=login">Iniciar Sesión</a> | 
            <a href="index.php?accion=registro">Registrarse</a>
        <?php endif; ?>
    </div>
    
    <h1>TerraCRUD</h1>
    
    <?php //if (isset($_SESSION['usuarioId'])): ?>
        <!-- <a href="index.php?accion=crear">Agregar Vehículo</a><br><br> -->
        <!-- <a href="index.php?accion=borrarTodo">Borrar Todo</a> -->

    <?php //endif; ?>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>ID Jugador</th>
            <th>Nombre</th>
            <th>tipo</th>
            <th>PS</th>
            <?php //if (isset($_SESSION['usuarioId'])): ?>
                <th>Acciones</th>
            <?php //endif; ?>
        </tr>
    
        <?php foreach ($terrarians as $p): ?>
        <tr>
            <td><?= $p->getId() ?></td>
            <td><?= $p->getTag() ?></td>
            <td><?= $p->getHP() ?></td>          
            <td><?= $p->getClass() ?></td>
            <td><?= ($p instanceof Mago) ? $p->getMana() : (($p instanceof Melee) ? $p->getBlade() : (($p instanceof Summoner) ? $p->getInvocacion() : $p->getWeapon())) ?></td>            
       
            <td>
                <a href="index.php?accion=editar&id=<?= $p->getId() ?>">Editar</a>
                |
                <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    
    </table>
<a href="index.php?accion=crear">Crear</a><br><br>    
    </body>
    </html>