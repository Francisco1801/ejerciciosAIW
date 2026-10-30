<?php
//seeder: para poblar la tabla modulos con datos iniciales

$host     = 'mysql';
$db       = 'siga';
$user     = 'root';
$password = 'rootpassword';
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,//SENTENCIAS PREPARADAS
];

try{
    $pdo = new PDO($dsn, $user, $password, $options);

    //insert de un solo modulo (con todas las columnas, id = null)
    $sql1 = "insert into modulos values (null, 'Desarrollo Web en Entorno Servidor', 'DWES', 12.00, 8);";

    //insert de un solo modulo indicando las columnas
    $sql2 = "insert into modulos
                (nombre, abreviatura, creditos, horassemanales)
                values ('Desarrollo Web en Entorno Cliente',
                        'DWEC',
                        10.50,
                        6);";

    //insert de varios modulos a la vez
    $sql3 = "insert into modulos
                (nombre, abreviatura, creditos, horassemanales)
                values
                    ('Bases de Datos', 'BD', 9.00, 6),
                    ('Lenguajes de Marca', 'LM', 6.00, 3),
                    ('Entornos de Desarrollo', 'ED', 5.50, null);";

    //$pdo->exec($sql1);
    //echo('insert 1 ok<br>');
    //$pdo->exec($sql2);
    //echo('insert 2 ok<br>');
    $pdo->exec($sql3);
    echo('insert 3 ok');
}catch (\Throwable $error){
    echo('se ha producido un error, aqui mas informacion: ');
    echo($error->getMessage());
}
 