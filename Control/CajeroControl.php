<?php
include("../Modelo/Cajero.php");


$usuario = new Cajero(
    $_REQUEST['nombre'], 
    $_REQUEST['apellidoP'], 
    $_REQUEST['apellidoM'], 
    $_REQUEST['email'], 
    $_REQUEST['calle'], 
    $_REQUEST['colonia'], 
    $_REQUEST['estado'], 
    $_REQUEST['codigoPostal']
);
$usuario ->crearUsuario($conexion);
?>