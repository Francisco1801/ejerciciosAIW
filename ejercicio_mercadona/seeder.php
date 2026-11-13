<?php
//seeder: para poblar la tabla mercadona con datos iniciales

require __DIR__ . '/conexion.php';

try {
    $pdo = conectar();

    //datos de los supermercados a insertar
    $mercadonas = [
        ['direccion' => 'Calle Larga 12',               'localidad' => 'Málaga',  'fecha_apertura' => '2015-03-12', 'encargado' => 'Antonio García Ruiz',   'telefono' => '952111222',    'ingreso_anual' => 1250000.500],
        ['direccion' => 'Avenida de Andalucía 45',      'localidad' => 'Málaga',  'fecha_apertura' => '2018-09-03', 'encargado' => 'María López Fernández', 'telefono' => '952333444',    'ingreso_anual' => 980000.000],
        ['direccion' => 'Calle Real 7',                 'localidad' => 'Granada', 'fecha_apertura' => '2012-05-21', 'encargado' => 'José Martín Sánchez',   'telefono' => '958555666',    'ingreso_anual' => 1430250.750],
        ['direccion' => 'Avenida de la Constitución 3', 'localidad' => 'Sevilla', 'fecha_apertura' => '2020-01-15', 'encargado' => 'Laura Pérez Gómez',     'telefono' => '954777888',    'ingreso_anual' => 765400.250],
        ['direccion' => 'Plaza Mayor 1',                'localidad' => 'Córdoba', 'fecha_apertura' => '2010-11-30', 'encargado' => 'Carlos Romero Díaz',    'telefono' => '+34957999000', 'ingreso_anual' => 0],
    ];

    //sentencia preparada: se prepara UNA vez...
    //(IGNORE: si se ejecuta el seeder dos veces no falla por las claves unicas, salta las repetidas)
    $sql = "INSERT IGNORE INTO mercadona
                (direccion, localidad, fecha_apertura, encargado, telefono, ingreso_anual)
            VALUES
                (:direccion, :localidad, :fecha_apertura, :encargado, :telefono, :ingreso_anual);";

    $sentencia_preparada = $pdo->prepare($sql);

    //...y se EJECUTA dentro de un bucle, una vez por cada supermercado
    $insertados = 0;
    foreach ($mercadonas as $mercadona) {
        $sentencia_preparada->execute($mercadona);
        $insertados += $sentencia_preparada->rowCount();
        echo('insert ok: ' . $mercadona['direccion'] . ' (' . $mercadona['localidad'] . ')<br>');
    }

    echo("Se han insertado $insertados supermercados nuevos.");
} catch (\Throwable $error) {
    echo('se ha producido un error, aqui mas informacion: ');
    echo($error->getMessage());
}
