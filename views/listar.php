<?php 
$miColor = $_COOKIE['bgcolor'] ?? '#ffffff'; 
$idioma = $_COOKIE['idioma'] ?? 'es';
// Si no existe la cookie, ponemos un color por defecto (ej: blanco)

$textos = [
    'es' => [
        'titulo' => 'Panel de Control',
        'nombre' => 'Nombre',
        'clase'  => 'Tipo',
        'ps'     => 'Puntos de Vida',
        'acciones' => 'Acciones'
    ],
    'en' => [
        'titulo' => 'Control Panel',
        'nombre' => 'Name',
        'clase'  => 'Class',
        'ps'     => 'Health Points',
        'acciones' => 'Actions'
    ]
];

// Atajo para no escribir tanto: guardamos el idioma actual en $t[cite: 1]
$t = $textos[$idioma]; 
?>
    <!DOCTYPE html>
    <html>
    <head>
    <title>TerraCRUD</title>
    </head>
<body style="background-color: <?= $miColor ?>;">
    <!-- Menú de configuración (Enlaces que activan el controlador) -->
    <div>
        <b>Idiomas:</b> 
        <a href="index.php?accion=idioma&lang=es">ES</a> | <a href="index.php?accion=idioma&lang=en">EN</a>
        <br>
        <b>Colores:</b> 
<a href="index.php?accion=color&c=lightblue">Azul</a> | 
        <a href="index.php?accion=color&c=lightgreen">Verde</a> |
        <a href="index.php?accion=color&c=white">Reset</a>    </div>

    <div>
        <?php if (isset($_SESSION['usuarioID'])): ?>
            Bienvenido, <b><?= $_SESSION['usuarioEmail'] ?></b> |
            <a href="index.php?accion=logout">Cerrar Sesión</a>
        <?php else: ?>
            <a href="index.php?accion=login">Iniciar Sesión</a> | 
            <a href="index.php?accion=register">Registrarse</a>
        <?php endif; ?>
    </div>
    
    <h1>TerraCRUD</h1>
    
    <?php if (isset($_SESSION['usuarioID'])): ?>
        <a href="index.php?accion=crear">Agregar Terrariano</a><br><br> 
        <a href="index.php?accion=borrarTodo">Borrar Todo</a>

    <?php endif; ?>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>ID Jugador</th>
            <th><?= $t['nombre'] ?></th> 
            <th><?= $t['clase'] ?></th>  
            <th><?= $t['ps'] ?></th>     
            <?php if (isset($_SESSION['usuarioID'])): ?>
                <th><?= $t['acciones'] ?></th> 
            <?php endif; ?>
        </tr>
        
        <?php foreach ($terrarians as $p): ?>
        <tr>
            <td><?= $p->getId() ?></td>
            <td><?= $p->getTag() ?></td>
            <td><?= $p->getHP() ?></td>          
            <td><?= $p->getClass() ?></td>
            <td><?= ($p instanceof Melee) ? $p->getBlade() : (($p instanceof Mago) ? $p->getMana() : (($p instanceof Summoner) ? $p->getInvocacion() : $p->getWeapon())); ?></td>            
       
            <td>
                <a href="index.php?accion=editar&id=<?= $p->getId() ?>">Editar</a>
                |
                <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    
    </table>
    </body>
    </html>