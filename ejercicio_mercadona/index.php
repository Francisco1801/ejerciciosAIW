<?php
// index.php: LISTADO (Read) de todos los Mercadona

require __DIR__ . '/funciones.php';

$mensaje = leer_flash();
$tiendas = [];
$fallo   = null;

try {
    $pdo     = conectar();
    $tiendas = $pdo->query("SELECT * FROM mercadona ORDER BY localidad, direccion")->fetchAll();
} catch (\Throwable $error) {
    // Normalmente: la tabla no existe todavia (hay que ejecutar migration.php) o no hay conexion
    $fallo = $error->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadona</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>LISTADO DE MERCADONA</h1>

    <?php if ($mensaje): ?>
        <div class="mensaje <?= e($mensaje['tipo']) ?>"><?= e($mensaje['texto']) ?></div>
    <?php endif; ?>

    <?php if ($fallo): ?>
        <div class="mensaje error">
            No se han podido leer los datos. ¿Has ejecutado <a href="migration.php">migration.php</a>?<br>
            Detalle: <?= e($fallo) ?>
        </div>
    <?php else: ?>
        <p><a href="create.php">+ Dar de alta un Mercadona</a></p>

        <?php if (count($tiendas) === 0): ?>
            <p>No hay ningún Mercadona. Crea uno o ejecuta <a href="seeder.php">seeder.php</a>.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dirección</th>
                        <th>Localidad</th>
                        <th>Apertura</th>
                        <th>Encargado</th>
                        <th>Teléfono</th>
                        <th>Ingreso anual</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($tiendas as $t): ?>
                    <tr>
                        <td><?= e($t['id']) ?></td>
                        <td><?= e($t['direccion']) ?></td>
                        <td><?= e($t['localidad']) ?></td>
                        <td><?= e(date('d/m/Y', strtotime($t['fecha_apertura']))) ?></td>
                        <td><?= e($t['encargado']) ?></td>
                        <td><?= e($t['telefono']) ?></td>
                        <td class="num"><?= e(number_format((float) $t['ingreso_anual'], 3, ',', '.')) ?> €</td>
                        <td>
                            <a href="show.php?id=<?= e($t['id']) ?>">Ver</a> |
                            <a href="edit.php?id=<?= e($t['id']) ?>">Editar</a> |
                            <!-- el borrado va por POST (nunca por enlace GET) -->
                            <form class="inline" action="destroy.php" method="post"
                                  onsubmit="return confirm('¿Seguro que quieres borrar este Mercadona?');">
                                <input type="hidden" name="id" value="<?= e($t['id']) ?>">
                                <button type="submit">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
