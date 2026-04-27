<!DOCTYPE html>
<html>
<head>
    <title>Crear Producto</title>
    <style>
        .mana, .blade, .weapon, .invocacion{
            display:none;
        }
        form:has(option[value="mago"]:checked) .mana{
            display:block;
        }
        form:has(option[value="melee"]:checked) .blade{
            display:block;
        }
        form:has(option[value="ranger"]:checked) .weapon{
            display:block;
        }
        form:has(option[value="summoner"]:checked) .invocacion{
            display:block;
        }
    </style>
</head>
<body>
    <h1>Crear Producto</h1>

    <form method="POST">
        <br>
        <input type="text" name="tag" required placeholder="tag"><br><br>

        <br>
        <input type="number" name="hp" required placeholder="hp"><br><br>
        <br>
        ¿Qué Clase es?:
             <select name="class" id="class" class="option">
                 <option value="mago">mago</option>
                 <option value="melee">melee</option>
                 <option value="ranger">ranger</option>
                 <option value="summoner">summoner</option>
             </select>
        <br>
        <br><br>
        <div class="mago">
            <input type="number" name="mana" class="mana" placeholder="maná"><br>
        </div>
        <div class="melee">
            <input type="text" name="blade" class="blade" placeholder="Espada"><br>
        </div>
        <div class="ranger">
            <input type="text   " name="weapon" class="weapon" placeholder="Arma"><br>
        </div>
        <div class="summoner">
            <input type="number" name="invocacion" class="invocacion" placeholder="Invocación"><br>
        </div>
        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="index.php">Volver</a>
</body>
</html>
