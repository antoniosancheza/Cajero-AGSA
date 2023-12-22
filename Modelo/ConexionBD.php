<?php
class ConexionBD{
    public function conectorBD(){
        $conexion = mysqli_connect("localhost", "id21689063_root", "Z4f1r0*26", "id21689063_base_datos")
        or die ("Problemas en la conexion a la base de datos");
        return $conexion;
    }

    public function cerrarBD(){
        mysqli_close($this->conectorBD());
    }
}
?>