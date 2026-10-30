<?php
//migration: crea la tabla modulos en la base de datos siga

/*variables de conexion*/
$host     = 'mysql';
$db       = 'siga';
$user     = 'root';
$password = 'rootpassword';
$charset  = 'utf8mb4';

//Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,//SENTENCIAS PREPARADAS
];

try{
    $pdo = new PDO($dsn, $user, $password, $options);
    echo('la conexion ha funcionado <br>');

    $sql = "CREATE TABLE IF NOT EXISTS modulos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL UNIQUE,
        abreviatura VARCHAR(5) NOT NULL UNIQUE,
        creditos DECIMAL(4, 2) NOT NULL,
        horassemanales SMALLINT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    //ejecutar la sentencia en el servidor
    $pdo->exec($sql);

    echo "Conexión exitosa. La tabla 'modulos' se ha verificado o creado correctamente.";
}catch (\Throwable $error){
    echo('se ha producido un error, aqui mas informacion: ');
    echo '<pre>' . var_export($error, true) . '</pre>';
    echo($error->getMessage());
}