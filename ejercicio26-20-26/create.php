<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alta de módulos</title>
    </head>
    <body>
        <h1>ALTA DE MÓDULOS</h1>
        <!-- post: crear y editar -->
        <form action="store.php" method="post">
            <br>
            <label for="nombre">Nombre:</label>
            <input type="text"
                   name="nombre"
                   id="nombre"
                   value=""
                   placeholder="Introduce el nombre del módulo"
                   required
                   minlength="2"
                   maxlength="100">
            <br>
            <label for="abreviatura">Abreviatura:</label>
            <input type="text"
                   name="abreviatura"
                   id="abreviatura"
                   value=""
                   placeholder="Introduce la abreviatura"
                   required
                   minlength="1"
                   maxlength="5">
            <br>
            <label for="creditos">Créditos:</label>
            <input type="number"
                   name="creditos"
                   id="creditos"
                   value=""
                   placeholder="Introduce los créditos"
                   required
                   min="0.00"
                   max="99.99"
                   step="0.01">
            <br>
            <label for="horassemanales">Horas semanales:</label>
            <input type="number"
                   name="horassemanales"
                   id="horassemanales"
                   value=""
                   placeholder="Introduce las horas semanales"
                   min="0"
                   max="32767"
                   step="1">
            <br>
            <button type="submit">Alta de módulos</button>
        </form>
    </body>
</html>
