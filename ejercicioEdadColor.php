<?php
$alumnos = [
    ['Calderer Sánchez, Lucas', 'm', 17],
    ['Cano Merino, Carlos', 'm', 16],
    ['Chari, Abdelali', 'm', 18],
    ['García Zarco, Francisco José', 'm', 17],
    ['Gómez Pérez, Samuel', 'm', 16],
    ['Iáñez Navarro, Daniel', 'm', 17],
    ['López Lasheras, Alan', 'm', 16],
    ['Maldonado Cabezas, Francisco', 'm', 18],
    ['Martín Arias, Carlos', 'm', 17],
    ['Moreno González, Alexandra', 'f', 16],
    ['Muñoz Moreno, Elisabet', 'f', 17],
    ['Ourhzif, Aymane', 'm', 16],
    ['Sánchez Ortiz, Emilio David', 'm', 18],
    ['Sánchez Rodríguez, Beatriz', 'f', 17],
    ['Torres Gómez, Ignacio', 'm', 16],
    ['Atienza Bermúdez, Alejandro', 'm', 17],
    ['Uréndez Jiménez, Alba', 'f', 16],
    ['Uribe Aranda, Francisco', 'm', 18],
    ['Velasco Clavero, Pablo', 'm', 17],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizando el array</title>
</head>
<body>
    <h1>Visualizando el array</h1>
    <table border="1px">
    <tr>
        <td>#</td>
        <td>Alumno</td>
        <td>Genero</td>
        <td>Edad</td>
    </tr>
    
    <?php
        foreach($alumnos as $indice => $datosAlumno){
            $nombre = $datosAlumno[0];
            $genero = $datosAlumno[1];
            $edad = $datosAlumno[2];

            
            if ($edad % 2 == 0) {
                $color = "blue";
            } else {
                $color = "green";
            }
    ?>
    <tr>
        <td><?= $indice ?></td>
        <td><?= $nombre ?></td>
        <td><?= $genero ?></td>
        <td style="color: <?= $color ?>;"><?= $edad ?></td>
    </tr>
    <?php
        };
    ?>
    </table>
</body>
</html>