<?php
//migration: crea la tabla mercadona en la base de datos siga

require __DIR__ . '/conexion.php';

try {
    $pdo = conectar();
    echo('la conexion ha funcionado <br>');

    $sql = "CREATE TABLE IF NOT EXISTS mercadona (
        id BIGINT unsigned AUTO_INCREMENT PRIMARY KEY,
        direccion VARCHAR(150) NOT NULL,
        localidad VARCHAR(100) NOT NULL,
        fecha_apertura DATE NOT NULL,
        encargado VARCHAR(150) unique not null,
        telefono VARCHAR(12) null,
        ingreso_anual DECIMAL(10,3) default 0,
        CONSTRAINT uq_direccion_localidad UNIQUE (direccion, localidad)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    //ejecutar la sentencia en el servidor
    $pdo->exec($sql);

    echo "Conexión exitosa. La tabla 'mercadona' se ha verificado o creado correctamente.";
} catch (\Throwable $error) {
    echo('se ha producido un error, aqui mas informacion: ');
    echo($error->getMessage());
}
