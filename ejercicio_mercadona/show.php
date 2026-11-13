<?php
// show.php: DETALLE de un Mercadona (Read de un solo registro)

require __DIR__ . '/funciones.php';

$id = leer_id($_GET);
if ($id === null) {
    flash('error', 'Identificador no válido.');
    redirigir('index.php');
}

try {
    $pdo       = conectar();
    $sentencia = $pdo->prepare("SELECT * FROM mercadona WHERE id = :id");
    $sentencia->execute(['id' => $id]);
    $t = $sentencia->fetch();
} catch (\Throwable $error) {
    flash('error', 'Error al consultar el Mercadona: ' . $error->getMessage());
    redirigir('index.php');
}

if (!$t) {
    flash('error', 'No existe ningún Mercadona con ese identificador.');
    redirigir('index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Mercadona</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>DETALLE DE MERCADONA #<?= e($t['id']) ?></h1>
    <ul>
        <li><strong>Dirección:</strong> <?= e($t['direccion']) ?></li>
        <li><strong>Localidad:</strong> <?= e($t['localidad']) ?></li>
        <li><strong>Fecha de apertura:</strong> <?= e(date('d/m/Y', strtotime($t['fecha_apertura']))) ?></li>
        <li><strong>Encargado:</strong> <?= e($t['encargado']) ?></li>
        <li><strong>Teléfono:</strong> <?= e($t['telefono']) ?></li>
        <li><strong>Ingreso anual:</strong> <?= e(number_format((float) $t['ingreso_anual'], 3, ',', '.')) ?> €</li>
    </ul>
    <a href="edit.php?id=<?= e($t['id']) ?>">Editar</a> |
    <a href="index.php">Volver al listado</a>
</body>
</html>
