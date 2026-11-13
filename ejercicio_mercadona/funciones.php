<?php
// funciones.php: funciones comunes del CRUD (validacion, mensajes, escapado).

session_start(); // se usa para los mensajes "flash" y para recordar lo escrito si hay errores

require __DIR__ . '/conexion.php';

/** Escapa un texto para mostrarlo en HTML (evita XSS). */
function e($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

/** Guarda un mensaje para mostrarlo una sola vez en la siguiente pagina. */
function flash(string $tipo, string $texto): void
{
    $_SESSION['flash'] = ['tipo' => $tipo, 'texto' => $texto];
}

/** Devuelve (y borra) el mensaje guardado, o null si no hay. */
function leer_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

/** Redirige y termina el script. */
function redirigir(string $url): void
{
    header('Location: ' . $url);
    exit;
}

/** Lee un id entero positivo de un array (GET o POST). Devuelve null si no es valido. */
function leer_id(array $origen): ?int
{
    $id = filter_var($origen['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    return $id === false ? null : $id;
}

/**
 * Valida los datos del formulario.
 * Devuelve [datos_limpios, errores]. Si $errores esta vacio, los datos son validos.
 */
function validar_mercadona(array $post): array
{
    $errores = [];

    $direccion      = trim($post['direccion'] ?? '');
    $localidad      = trim($post['localidad'] ?? '');
    $fecha_apertura = trim($post['fecha_apertura'] ?? '');
    $encargado      = trim($post['encargado'] ?? '');
    $telefono       = str_replace(' ', '', trim($post['telefono'] ?? ''));
    $ingreso        = str_replace(',', '.', trim($post['ingreso_anual'] ?? ''));

    // direccion: obligatoria, max 150
    if ($direccion === '') {
        $errores['direccion'] = 'La dirección es obligatoria.';
    } elseif (mb_strlen($direccion) > 150) {
        $errores['direccion'] = 'La dirección no puede superar los 150 caracteres.';
    }

    // localidad: obligatoria, max 100
    if ($localidad === '') {
        $errores['localidad'] = 'La localidad es obligatoria.';
    } elseif (mb_strlen($localidad) > 100) {
        $errores['localidad'] = 'La localidad no puede superar los 100 caracteres.';
    }

    // fecha_apertura: obligatoria, formato AAAA-MM-DD y fecha real
    if ($fecha_apertura === '') {
        $errores['fecha_apertura'] = 'La fecha de apertura es obligatoria.';
    } else {
        $fecha = DateTime::createFromFormat('Y-m-d', $fecha_apertura);
        if (!$fecha || $fecha->format('Y-m-d') !== $fecha_apertura) {
            $errores['fecha_apertura'] = 'La fecha de apertura no es válida.';
        }
    }

    // encargado: obligatorio, max 150
    if ($encargado === '') {
        $errores['encargado'] = 'El encargado es obligatorio.';
    } elseif (mb_strlen($encargado) > 150) {
        $errores['encargado'] = 'El encargado no puede superar los 150 caracteres.';
    }

    // telefono: opcional (la columna admite NULL); si se escribe, 9-11 digitos con + opcional delante (max 12 caracteres)
    if ($telefono !== '' && !preg_match('/^\+?[0-9]{9,11}$/', $telefono)) {
        $errores['telefono'] = 'El teléfono debe tener entre 9 y 11 dígitos (puede empezar por +).';
    }

    // ingreso_anual: opcional (por defecto 0), DECIMAL(10,3) => hasta 7 enteros y 3 decimales
    if ($ingreso === '') {
        $ingreso = '0';
    } elseif (!preg_match('/^[0-9]{1,7}(\.[0-9]{1,3})?$/', $ingreso)) {
        $errores['ingreso_anual'] = 'El ingreso anual debe ser un número positivo de hasta 7 cifras enteras y 3 decimales.';
    }

    $datos = [
        'direccion'      => $direccion,
        'localidad'      => $localidad,
        'fecha_apertura' => $fecha_apertura,
        'encargado'      => $encargado,
        'telefono'       => $telefono === '' ? null : $telefono, // vacio --> NULL
        'ingreso_anual'  => $ingreso,
    ];

    return [$datos, $errores];
}

/**
 * Traduce un error de clave duplicada de MySQL (codigo 1062) a un mensaje por campo.
 * Devuelve null si el error no es de duplicado.
 */
function error_duplicado(\Throwable $error): ?array
{
    if (!($error instanceof PDOException) || ($error->errorInfo[1] ?? null) !== 1062) {
        return null;
    }
    $mensaje = $error->getMessage();
    if (strpos($mensaje, 'uq_direccion_localidad') !== false) {
        return ['direccion' => 'Ya existe un Mercadona con esa dirección en esa localidad.'];
    }
    if (strpos($mensaje, 'encargado') !== false) {
        return ['encargado' => 'Ese encargado ya está asignado a otro Mercadona.'];
    }
    return ['direccion' => 'Ya existe un registro con esos datos.'];
}
