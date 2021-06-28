<?php
    session_start();

    if (!isset($_SESSION['alumnos'])) {
        $_SESSION['alumnos'] = array();
    }

    if (isset($_POST['insertar'])) {

        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $sueldo = $_POST['sueldo'];
        $lugar = $_POST['lugar'];
        $depar = $_POST['depar'];


        if (empty($dni) || empty($nombre) || empty($apellido) || empty($sueldo) || empty($lugar) || empty($depar)) {
            echo "Rellena todos los valores";
        } else {

            $alumno = array(
                "dni" => $dni,
                "nombre" => $nombre,
                "apellido" => $apellido,
                "sueldo" => $sueldo,
                "lugar" => $lugar,
                "depar" => $depar
            );

            if (isset($_SESSION['alumnos'][$dni])) {
                echo "Se ha modificado el empleado con cedula: " . $dni;
            } else {
                echo "Se ha insertado el nuevo empleado";
            }

            $_SESSION['alumnos'][$dni] = $alumno;

            print_r($_SESSION['alumnos']);
        }
    }


    ?>

<?php

if (isset($_POST['mostrar'])) {

    if (count($_SESSION['alumnos']) === 0) {
        echo "<p>No hay alumnos</p>";
    } else {


        echo "<table border=1>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th>Cedula</th>";
        echo "<th>Nombre</th>";
        echo "<th>Apellido</th>";
        echo "<th>Sueldo</th>";
        echo "<th>Lugar de trabajo</th>";
        echo "<th>Departamento</th>";
        echo "</tr>";
        

        foreach ($_SESSION['alumnos'] as $key => $value) {
            ?>
            <tr>
                <td><input type="checkbox" name="dnis[]" value="<?php echo $key; ?>"></td>
                <td><?php echo $value['dni']; ?></td>
                <td><?php echo $value['nombre']; ?></td>
                <td><?php echo $value['apellido']; ?></td>
                <td><?php echo $value['sueldo']; ?></td>
                <td><?php echo $value['lugar']; ?></td>
                <td><?php echo $value['depar']; ?></td>
            </tr>
<?php
        }

        echo "</table>";
    }
}

?>
