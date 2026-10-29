
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

    $sql = "INSERT INTO modulos
        (nombre, abreviatura, creditos, horassemanales)
        VALUES
        ('Programacion', 'PROG', 12.00, 8),
        ('Bases de datos', 'BD', 10.00, 6),
        ('Lenguajes de marcas', 'LM', 8.00, 4);";

    $pdo->exec($sql);

    echo "Los modulos se han insertado correctamente.";

} catch (\Throwable $error) {
    echo "Se ha producido un error: ";
    echo $error->getMessage();
}
