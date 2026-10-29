
<?php

$host     = 'mysql';
$db       = 'siga';
$user     = 'sigauser';
$password = 'sigauser';
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    if (!isset($_POST['nombre']) ||
        !isset($_POST['abreviatura']) ||
        !isset($_POST['creditos'])) {
        header('Location: error.php');
        exit;
    }

    $nombre = $_POST['nombre'];
    $abreviatura = $_POST['abreviatura'];
    $creditos = $_POST['creditos'];

    $horassemanales = $_POST['horassemanales'] ?? null;

    if ($horassemanales === '') {
        $horassemanales = null;
    }

    $sql = "INSERT INTO modulos
        (nombre, abreviatura, creditos, horassemanales)
        VALUES
        (:nombre, :abreviatura, :creditos, :horassemanales);";

    $sentencia_preparada = $pdo->prepare($sql);

    $datos = [
        'nombre' => $nombre,
        'abreviatura' => $abreviatura,
        'creditos' => $creditos,
        'horassemanales' => $horassemanales
    ];

    $sentencia_preparada->execute($datos);

    header('Location: exito.php');
    exit;

} catch (\Throwable $error) {
    header('Location: error.php');
    exit;
}
