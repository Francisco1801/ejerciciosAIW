<?php
// update.php: recibe los datos de edit.php y actualiza el registro.

require __DIR__ . '/funciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('index.php');
}

$id = leer_id($_POST);
if ($id === null) {
    flash('error', 'Identificador no válido.');
    redirigir('index.php');
}

[$datos, $errores] = validar_mercadona($_POST);

if (count($errores) === 0) {
    try {
        $pdo = conectar();

        $sql = "UPDATE mercadona SET
                    direccion      = :direccion,
                    localidad      = :localidad,
                    fecha_apertura = :fecha_apertura,
                    encargado      = :encargado,
                    telefono       = :telefono,
                    ingreso_anual  = :ingreso_anual
                WHERE id = :id;";

        $sentencia_preparada = $pdo->prepare($sql);
        $sentencia_preparada->execute($datos + ['id' => $id]);

        // OJO: rowCount() es 0 tambien si no se cambio nada, asi que comprobamos que el id existe
        $existe = $pdo->prepare("SELECT COUNT(*) FROM mercadona WHERE id = :id");
        $existe->execute(['id' => $id]);
        if ((int) $existe->fetchColumn() === 0) {
            flash('error', 'No existe ningún Mercadona con ese identificador.');
            redirigir('index.php');
        }

        flash('exito', 'El Mercadona se ha actualizado con éxito.');
        redirigir('index.php');

    } catch (\Throwable $error) {
        $duplicado = error_duplicado($error);
        if ($duplicado !== null) {
            $errores = $duplicado;
        } else {
            flash('error', 'Se ha producido un error al actualizar el Mercadona: ' . $error->getMessage());
            redirigir('index.php');
        }
    }
}

// Hay errores: volvemos al formulario de edicion conservando lo escrito
$_SESSION['errores'] = $errores;
$_SESSION['valores'] = $datos;
redirigir('edit.php?id=' . $id);
