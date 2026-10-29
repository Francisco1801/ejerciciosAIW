
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

    $sql = "CREATE TABLE IF NOT EXISTS modulos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        abreviatura VARCHAR(5) NOT NULL,
        creditos DECIMAL(4,2) NOT NULL,
        horassemanales SMALLINT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);

    echo "La tabla 'modulos' se ha creado correctamente.";

} catch (\Throwable $error) {
    echo "Se ha producido un error: ";
    echo $error->getMessage();
}
