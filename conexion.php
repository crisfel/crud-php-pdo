<?php

class conexion
{

    static public function conexionBD()
    {
        $host = 'localhost';
        $dbName = 'phpdb';
        $userName = 'root';
        $password = '';

        try {
            $conexion = new PDO("mysql:host=$host; dbname=$dbName", $userName, $password);
            //echo 'SE CONECTO CORRECTAMENTE A LA BASE DE DATOS';

        } catch(PDOException $e) {
            echo 'NO SE LOGRO CONECTAR CORRECTAMENTE A LA BASE DE DATOS '.$dbName.', error '.$e;
        }

        return $conexion;
    }



}