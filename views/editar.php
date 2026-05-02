<!DOCTYPE html>
<html>
<head>
    <title>Crear Producto</title>
    <style>
        .mana, .blade, .weapon, .invocacion{
            display:none;
        }
        form:has(option[value="Mago"]:checked) .mana{
            display:block;
        }
        form:has(option[value="Melee"]:checked) .blade{
            display:block;
        }
        form:has(option[value="Ranger"]:checked) .weapon{
            display:block;
        }
        form:has(option[value="Summoner"]:checked) .invocacion{
            display:block;
        }
    </style>
</head>
<body>
    <h1>Editar Terrariano</h1>

    <form method="POST">
        <br>
        <input type="text" name="tag" required placeholder="tag"><br><br>

        <br>
        <input type="number" name="hp" required placeholder="hp"><br><br>
        <br>
        ¿Qué Clase eres?:
             <select name="class" id="class" class="option"> // hay que tener cuidado con los Values, con las mayúsculas y minusculas
                 <option value="Mago">mago</option>
                 <option value="Melee">melee</option>
                 <option value="Ranger">ranger</option>
                 <option value="Summoner">summoner</option>
             </select>
        <br>
        <br><br>
        <div class="Mago">
            <input type="number" name="mana" class="mana" placeholder="maná"><br>
        </div>
        <div class="Melee">
            <input type="text" name="blade" class="blade" placeholder="Espada"><br>
        </div>
        <div class="Ranger">
            <input type="text   " name="weapon" class="weapon" placeholder="Arma"><br>
        </div>
        <div class="Summoner">
            <input type="number" name="invocacion" class="invocacion" placeholder="Invocación"><br>
        </div>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
