<?php
// create.php: formulario de ALTA (Create)

require __DIR__ . '/funciones.php';

// Si store.php devolvio errores, recuperamos lo que el usuario habia escrito
$errores = $_SESSION['errores'] ?? [];
$valores = $_SESSION['valores'] ?? [];
unset($_SESSION['errores'], $_SESSION['valores']);

$accion = 'store.php';
$boton  = 'Dar de alta';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Mercadona</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>ALTA DE MERCADONA</h1>
    <?php require __DIR__ . '/_form.php'; ?>
</body>
</html>
