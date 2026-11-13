<?php
// destroy.php: BORRA un Mercadona (Delete). Solo por POST.

require __DIR__ . '/funciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('index.php');
}

$id = leer_id($_POST);
if ($id === null) {
    flash('error', 'Identificador no válido.');
    redirigir('index.php');
}

try {
    $pdo       = conectar();
    $sentencia = $pdo->prepare("DELETE FROM mercadona WHERE id = :id");
    $sentencia->execute(['id' => $id]);

    if ($sentencia->rowCount() === 0) {
        flash('error', 'No existe ningún Mercadona con ese identificador.');
    } else {
        flash('exito', 'El Mercadona se ha borrado con éxito.');
    }
} catch (\Throwable $error) {
    flash('error', 'Se ha producido un error al borrar el Mercadona: ' . $error->getMessage());
}

redirigir('index.php');
