<?php
// edit.php: formulario de EDICION (Update). Carga el registro y lo muestra en el formulario.

require __DIR__ . '/funciones.php';

$id = leer_id($_GET);
if ($id === null) {
    flash('error', 'Identificador no válido.');
    redirigir('index.php');
}

// Si update.php devolvio errores, usamos lo que el usuario habia escrito
$errores = $_SESSION['errores'] ?? [];
$valores = $_SESSION['valores'] ?? null;
unset($_SESSION['errores'], $_SESSION['valores']);

if ($valores === null) {
    try {
        $pdo       = conectar();
        $sentencia = $pdo->prepare("SELECT * FROM mercadona WHERE id = :id");
        $sentencia->execute(['id' => $id]);
        $valores = $sentencia->fetch();
    } catch (\Throwable $error) {
        flash('error', 'Error al consultar el Mercadona: ' . $error->getMessage());
        redirigir('index.php');
    }

    if (!$valores) {
        flash('error', 'No existe ningún Mercadona con ese identificador.');
        redirigir('index.php');
    }
}

$accion = 'update.php';
$boton  = 'Guardar cambios';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mercadona</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>EDITAR MERCADONA #<?= e($id) ?></h1>
    <?php require __DIR__ . '/_form.php'; ?>
</body>
</html>
