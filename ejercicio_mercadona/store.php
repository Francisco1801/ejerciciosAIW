<?php
// store.php: recibe los datos de create.php y los inserta en la tabla mercadona.

require __DIR__ . '/funciones.php';

// Solo se admite POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('create.php');
}

[$datos, $errores] = validar_mercadona($_POST);

if (count($errores) === 0) {
    try {
        $pdo = conectar();

        // Sentencia preparada --> evita inyecciones SQL
        $sql = "INSERT INTO mercadona
                    (direccion, localidad, fecha_apertura, encargado, telefono, ingreso_anual)
                VALUES
                    (:direccion, :localidad, :fecha_apertura, :encargado, :telefono, :ingreso_anual);";

        $sentencia_preparada = $pdo->prepare($sql);
        $sentencia_preparada->execute($datos);

        flash('exito', 'El Mercadona se ha insertado con éxito.');
        redirigir('index.php');

    } catch (\Throwable $error) {
        $duplicado = error_duplicado($error);
        if ($duplicado !== null) {
            $errores = $duplicado;
        } else {
            flash('error', 'Se ha producido un error al insertar el Mercadona: ' . $error->getMessage());
            redirigir('index.php');
        }
    }
}

// Hay errores: volvemos al formulario conservando lo escrito
$_SESSION['errores'] = $errores;
$_SESSION['valores'] = $datos;
redirigir('create.php');
