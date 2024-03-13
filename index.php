<?php
include_once('conexion.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <title> Conexión PHP y MYsql</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body style="background-color: #C3C1C1">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <p style="font-size: 40px; font-family: verdana, helvetica; font-weight: bold;">
                    CRUD con php puro
                </p>
            </div>
        </div>
    </p>
    <div class="container d-flex justify-content-center" style="margin-left: auto; margin-right: auto; margin-top: 3%; background-color:white; padding:5%; border-radius: 10px;">
        <form method="POST" action="">
            <div class="row d-flex justify-content-center">
                    <div class="form-group col-md-8" style="margin:10px;">
                        <label for="documento" style="font-family: arial, helvetica; font-style: italic;">Documento: </label>
                        <input class="form-control" type="text" name="documento">
                    </div>
                    <div class="form-group col-md-8" style="margin:10px;">
                        <label for="nombre" style="font-family: arial, helvetica; font-style: italic;">Nombre: </label>
                        <input class="form-control" type="text" name="nombre">
                    </div>
                    <div class="form-group col-md-8" style="margin:10px;">
                        <label for="direccion" style="font-family: arial, helvetica; font-style: italic;">Dirección: </label>
                        <input class="form-control" type="text" name="direccion">
                    </div>
                    <div class="form-group col-md-8" style="margin:10px;">
                        <label for="telefono" style="font-family: arial, helvetica; font-style: italic;">Teléfono: </label>
                        <input class="form-control" type="text" name="telefono">
                    </div>
            </div>
            <div class="row d-flex justify-content-center" style="width:40%; margin-left: auto; margin-right: auto; 1px solid black">
                <div class="col-sm-3 d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="Consultar" name="consultar">
                </div>
                <div class="col-sm-3 d-flex justify-content-center">
                    <input type="submit" class="btn btn-success" value="Registrar" name="registrar">
                </div>
                <div class="col-sm-3 d-flex justify-content-center">
                    <input type="submit" style="color:white;" class="btn btn-info" value="Actualizar" name="actualizar">
                </div>
                <div class="col-sm-3 d-flex justify-content-center">
                    <input type="submit" class="btn btn-danger" value="Eliminar" name="eliminar">
                </div>
            </div>
        </form>
    </div>

        <div class="container d-flex justify-content-center" style="margin-left: auto; margin-right: auto; background-color:white; padding:5%; border-radius: 10px;">
            <?php
                //var_dump($_POST['actualizar']);
                $doc = '';
                $nom = '';
                $dir = '';
                $tel = '';
                if (isset($_POST['consultar'])) {
                    $doc = $_POST['documento'];
                    $existe = 0;
                    if ($doc == '') {
                        echo "El campo documento es obligatorio";
                    } else {
                        $consulta = Conexion::conexionBD()->prepare("SELECT * FROM USUARIOS WHERE document = '$doc'");
                        $consulta->execute();
                        echo '<ul>';
                        while (($resultado = $consulta->fetch()) !== false) {
                            echo '<li>' . $resultado['document'] . '</li>'
                                . '<li>' . $resultado['nombre'] . '</li>'
                                . '<li>' . $resultado['direccion'] . '</li>'
                                . '<li>' . $resultado['telefono'] . '</li>';
                            $existe++;
                        }
                        echo '</ul>';
                        if ($existe == 0) {
                            echo 'El documento no existe';
                        }
                    }
                }

                if (isset($_POST['registrar'])) {
                    $doc = $_POST['documento'];
                    $nom = $_POST['nombre'];
                    $dir = $_POST['direccion'];
                    $tel = $_POST['telefono'];

                    if ($doc == '' || $nom == '' || $dir == '') {
                        echo "Los campos son obligatorios";
                    } else {
                        $consulta = Conexion::conexionBD()->prepare("INSERT INTO USUARIOS (document, nombre, direccion, telefono) values ('$doc', '$nom', '$dir', '$tel')");
                        $consulta->execute();

                    }
                }

            if (isset($_POST['actualizar'])) {
                $existe = 0;
                $doc = $_POST['documento'];
                $nom = $_POST['nombre'];
                $dir = $_POST['direccion'];
                $tel = $_POST['telefono'];

                if ($doc == '' || $nom == '' || $dir == '') {
                    echo "Los campos son obligatorios";
                } else {
                    $consulta = Conexion::conexionBD()->prepare("SELECT * FROM USUARIOS WHERE document = '$doc'");
                    $consulta->execute();
                    while (($resultado = $consulta->fetch()) !== false) {
                        $existe++;
                    }
                    if ($existe == 0) {
                        echo 'El documento no existe';
                    } else {
                        $consulta = Conexion::conexionBD()->prepare("UPDATE USUARIOS
                                                                SET document = '$doc',
                                                                    nombre = '$nom',
                                                                    direccion = '$dir',
                                                                    telefono = '$tel' 
                                                                WHERE document = '$doc'"
                        );
                        $consulta->execute();
                        echo 'Actualizado con exito';
                    }
                }
            }

            if (isset($_POST['eliminar'])) {
                $doc = $_POST['documento'];
                $existe = 0;
                if ($doc == '') {
                    echo "El campo documento es obligatorio";
                } else {
                    $consulta = Conexion::conexionBD()->prepare("SELECT * FROM USUARIOS WHERE document = '$doc'");
                    $consulta->execute();
                    while (($resultado = $consulta->fetch()) !== false) {
                        $existe++;
                    }
                    if ($existe == 0) {
                        echo 'El documento no existe';
                    } else {
                        $consulta = Conexion::conexionBD()->prepare("DELETE FROM USUARIOS WHERE document = '$doc'");
                        $consulta->execute();
                        echo 'Usuario eliminado con exito';
                    }
                }

            }

            ?>
        </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>
