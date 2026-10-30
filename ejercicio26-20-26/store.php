<?php

// store.php: recibe los datos de un modulo nuevo desde create.php
// y los inserta en la tabla modulos.

$host     = 'mysql';
$db       = 'siga';
$user     = 'root';
$password = 'rootpassword';
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false, //sentencias preparadas
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    // Campos obligatorios
    if (!isset($_POST['nombre']) ||
        !isset($_POST['abreviatura']) ||
        !isset($_POST['creditos'])) {
        header('Location: error.php');
        exit;
    }

    $nombre         = $_POST['nombre'];
    $abreviatura    = $_POST['abreviatura'];
    $creditos       = $_POST['creditos'];
    $horassemanales = $_POST['horassemanales'] ?? null;

    // Campo opcional vacio --> NULL
    if ($horassemanales === '') {
        $horassemanales = null;
    }

    // Sentencia preparada --> evita inyecciones SQL
    $sql = "INSERT INTO modulos
                (nombre, abreviatura, creditos, horassemanales)
            VALUES
                (:nombre, :abreviatura, :creditos, :horassemanales);";

    $sentencia_preparada = $pdo->prepare($sql);

    $datos = [
        'nombre'         => $nombre,
        'abreviatura'    => $abreviatura,
        'creditos'       => $creditos,
        'horassemanales' => $horassemanales
    ];

    $sentencia_preparada->execute($datos);

    header('Location: exito.php');
    exit;

} catch (\Throwable $error) {
    // Para depurar, cambia la redireccion por: echo $error->getMessage();
    header('Location: error.php');
    exit;
}