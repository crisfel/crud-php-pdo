<?php
//var_dump($_POST['actualizar']);
include('conexion.php');

$doc = '';
$nom = '';
$dir = '';
$tel = '';


if (isset($_POST['consultar'])) {
    $doc = $_POST['documento'];


    $consulta = Conexion::conexionBD()->prepare("SELECT * FROM USUARIOS WHERE document = '$doc'");
    $consulta->execute();

    echo '<ul>';
    while (($resultado = $consulta->fetch()) !== false) {
        echo '<li>'.$resultado['document'].'</li>'
            .'<li>'.$resultado['nombre'].'</li>'
            .'<li>'.$resultado['direccion'].'</li>'
            .'<li>'.$resultado['telefono'].'</li>';
    }
    echo '</ul>';
}
?>

