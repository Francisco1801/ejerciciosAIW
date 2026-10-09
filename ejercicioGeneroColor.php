<?php
$alumnos = [
['Calderer Sánchez, Lucas', 'm',],
['Cano Merino, Carlos', 'm',],
['Chari, Abdelali', 'm',],
['García Zarco, Francisco José', 'm',],
['Gómez Pérez, Samuel', 'm',],
['Iáñez Navarro, Daniel', 'm',],
['López Lasheras, Alan', 'm',],
['Maldonado Cabezas, Francisco', 'm',],
['Martín Arias, Carlos', 'm',],
['Moreno González, Alexandra', 'f',],
['Muñoz Moreno, Elisabet', 'f',],
['Ourhzif, Aymane', 'm',],
['Sánchez Ortiz, Emilio David', 'm',],
['Sánchez Rodríguez, Beatriz', 'f',],
['Torres Gómez, Ignacio', 'm',],
['Atienza Bermúdez, Alejandro', 'm',],
['Uréndez Jiménez, Alba', 'f',],
['Uribe Aranda, Francisco', 'm',],
['Velasco Clavero, Pablo', 'm',],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Visualizando el array</h1>
    <table border = "1px">
    <tr>
        <td>#</td>
        <td>Alumno</td>
        <td>Genero</td>
    </tr>
    
    <?php
        foreach($alumnos as $indice => $alumnoGenero){
    ?>
    <tr>
        <td><?= $indice ?></td>
        <td><?= $alumnoGenero[0] ?></td>
        <td>
            <?php
                if ($alumnoGenero[1] == 'm') {
                    echo '<span style="color: green;">m</span>';
                } else {
                    echo '<span style="color: blue;">f</span>';
                }
            ?>
        </td>
    </tr>
    <?php
        };
    ?>
    </table>
</body>
</html>
//