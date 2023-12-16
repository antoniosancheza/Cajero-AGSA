<?php
include("../Modelo/Cajero.php");


$usuario = new Cajero();

switch($_REQUEST['option']){
    case 1:
        $usuario->iniciarlizar($_REQUEST['nombre'],
            $_REQUEST['apellidoP'],
            $_REQUEST['apellidoM'],
            $_REQUEST['email'],
            $_REQUEST['calle'],
            $_REQUEST['colonia'],
            $_REQUEST['estado'],
            $_REQUEST['codigoPostal']);
        $usuario->crearUsuario($conexion);
    break;

    case 2:
        $usuario -> login($conexion, $_REQUEST['nip']);
    break;
}
?>