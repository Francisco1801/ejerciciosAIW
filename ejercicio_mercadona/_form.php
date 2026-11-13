<?php
// _form.php: formulario compartido por create.php y edit.php.
// Variables que espera: $accion (store.php | update.php), $valores, $errores, $boton, $id (solo al editar)

/** Pinta el mensaje de error de un campo, si lo hay. */
function error_campo(array $errores, string $campo): void
{
    if (isset($errores[$campo])) {
        echo '<span class="error">' . e($errores[$campo]) . '</span>';
    }
}
?>
<!-- post: crear y editar -->
<form action="<?= e($accion) ?>" method="post">
    <?php if (isset($id)): ?>
        <input type="hidden" name="id" value="<?= e($id) ?>">
    <?php endif; ?>

    <label for="direccion">Dirección:</label>
    <input type="text"
           name="direccion"
           id="direccion"
           value="<?= e($valores['direccion'] ?? '') ?>"
           placeholder="Introduce la dirección"
           required
           maxlength="150">
    <?php error_campo($errores, 'direccion'); ?>
    <br>

    <label for="localidad">Localidad:</label>
    <input type="text"
           name="localidad"
           id="localidad"
           value="<?= e($valores['localidad'] ?? '') ?>"
           placeholder="Introduce la localidad"
           required
           maxlength="100">
    <?php error_campo($errores, 'localidad'); ?>
    <br>

    <label for="fecha_apertura">Fecha de apertura:</label>
    <input type="date"
           name="fecha_apertura"
           id="fecha_apertura"
           value="<?= e($valores['fecha_apertura'] ?? '') ?>"
           required>
    <?php error_campo($errores, 'fecha_apertura'); ?>
    <br>

    <label for="encargado">Encargado:</label>
    <input type="text"
           name="encargado"
           id="encargado"
           value="<?= e($valores['encargado'] ?? '') ?>"
           placeholder="Introduce el nombre del encargado"
           required
           maxlength="150">
    <?php error_campo($errores, 'encargado'); ?>
    <br>

    <label for="telefono">Teléfono:</label>
    <input type="text"
           name="telefono"
           id="telefono"
           value="<?= e($valores['telefono'] ?? '') ?>"
           placeholder="Ej: 952123456 (opcional)"
           maxlength="12"
           pattern="\+?[0-9]{9,11}">
    <?php error_campo($errores, 'telefono'); ?>
    <br>

    <label for="ingreso_anual">Ingreso anual (€):</label>
    <input type="number"
           name="ingreso_anual"
           id="ingreso_anual"
           value="<?= e($valores['ingreso_anual'] ?? '0') ?>"
           min="0"
           max="9999999.999"
           step="0.001">
    <?php error_campo($errores, 'ingreso_anual'); ?>
    <br>

    <button type="submit"><?= e($boton) ?></button>
    <a href="index.php">Cancelar</a>
</form>
