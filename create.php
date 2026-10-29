
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de modulos</title>
</head>
<body>

    <h1>Alta de modulos</h1>

    <form action="store.php" method="post">

        <label for="nombre">Nombre</label>
        <input type="text"
               name="nombre"
               id="nombre"
               required
               maxlength="100">
        <br>

        <label for="abreviatura">Abreviatura</label>
        <input type="text"
               name="abreviatura"
               id="abreviatura"
               required
               maxlength="5">
        <br>

        <label for="creditos">Creditos</label>
        <input type="number"
               name="creditos"
               id="creditos"
               required
               min="0"
               max="99.99"
               step="0.01">
        <br>

        <label for="horassemanales">Horas semanales</label>
        <input type="number"
               name="horassemanales"
               id="horassemanales"
               min="0"
               max="32767">
        <br>

        <button type="submit">Alta modulo</button>

    </form>

</body>
</html>
