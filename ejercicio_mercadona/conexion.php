<?php
// conexion.php: devuelve una conexion PDO a la base de datos siga.
// Se incluye (require) desde el resto de archivos para no repetir los datos.

function conectar(): PDO
{
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
        PDO::ATTR_EMULATE_PREPARES   => false, //SENTENCIAS PREPARADAS
    ];

    return new PDO($dsn, $user, $password, $options);
}
