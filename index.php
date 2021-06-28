<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script>src="https://code.jquery.com/jquery-3.6.0.min.js"</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Ejercicio 3</title>
    <h4 style="text-align: center">Ejercicio elaborado por Samuel Figueroa</h4>
</head>
<script>

function ingresar(dni, nombre, apellido, sueldo, lugar, depar) {
            var empleado = {
                "cedula" : dni,
                "nombre" : nombre,
                "apellido" : apellido,
                "sueldo" : sueldo,
                "lugar" : lugar,
                "depar" : depar
                };
            $.ajax({
            url: "ejecutar.php",
            type: "post",
            data: empleado,
            beforeSend: function() {
            $("#resp").html("Procesando, espere por favor...");
            },
            fail: function() {
            $("#resp").html("Error al agregar el trabajador");
            },
            success: function(response) {
            $("#resp").html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
            });
            console.log(dni, nombre, apellido, sueldo, lugar, depar);

}
</script>

<body>





<div class="container mt-5">

    <div class ="row">
        <div class="col-md-3">
        <h1>Ingrese Datos</h1>
            <form method="post">

        
            <input class="form-control mb-3" type="text" id="dni" name="dni" placeholder="Cedula"  />
            
            <input class="form-control mb-3" type="text" id="nombre" name="nombre" placeholder="Nombre"  />
            
            <input class="form-control mb-3" type="text" id="apellido" name="apellido" placeholder="Apellido" />
        
            <input class="form-control mb-3" type="text" id="sueldo" name="sueldo" placeholder="Sueldo" />
            
            <input class="form-control mb-3" type="text" id="lugar" name="lugar" placeholder="Lugar de trabajo" />
        
            <input class="form-control mb-3" type="text" id="depar" name="depar" placeholder="Departamento"  />
            
            <button  type="submit" name="insertar" class="btn waves-effect waveslight; btn btn-success" >Ingresar</button>
            <button type="submit" name="mostrar"  class="btn btn-primary">Mostrar</button>

        </div>

    </div>

        
</div>

<div class="container mt-8">
<h3 style="text-align: center">Empleados Ingresados</h3>  
<br></br> 
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
    


</div>



    </form>

</body>

</html>