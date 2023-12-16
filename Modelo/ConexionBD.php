<?php
class ConexionBD{
    public function conectorBD(){
        $conexion = mysqli_connect("localhost", "root", "", "CajeroAGSA")
        or die ("Problemas en la conexion a la base de datos");
        return $conexion;
    }

    public function cerrarBD(){
        mysqli_close($this->conectorBD());
    }
}
?>