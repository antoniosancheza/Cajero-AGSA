<?php

include ("ConexionBD.php");

$conexion = new ConexionBD();
$conexion ->conectorBD();
$conexion ->cerrarBD();
class Cajero{

    //Cracion de variables
    private $nombre;
    private $apellidoP;
    private $apellidoM;
    private $email;

    private $calle;
    private $colonia;
    private $estado;
    private $codigoPostal;

    //Declaracion del constructor
    public function __construct($nombre, $apellidoP, $apellidoM, $email, $calle, $colonia, $estado, $codigoPostal){
        $this -> nombre = $nombre;
        $this -> apellidoP = $apellidoP;
        $this-> apellidoM = $apellidoM;
        $this -> email = $email;
        $this -> calle = $calle;
        $this -> colonia = $colonia;
        $this -> estado = $estado;
        $this-> codigoPostal = $codigoPostal;
    }


    //Metodo para crar nuevos usuarios o tarjetas
    public function crearUsuario($conexion){
        //Crecion de variables para el metodo
        $nip_aleatorio = sprintf('%04d', rand(0, 9999));
        $nip_encriptado = md5($nip_aleatorio);

        //Validacion si existe un usuario con ese correo
        $registro = mysqli_query($conexion ->conectorBD(), "SELECT * FROM usuarios WHERE usuario_nombre = '$this->nombre' OR usuario_email = '$this->email'");
        if($reg = mysqli_fetch_array($registro)){
            echo '<script>alert("El usuario o el correo electronico ya existe")</script>';
            header('refresh:0.5; url=../Vista/solicitarTarjeta.html');
        }else{
            //Crecion del nuevo usuario
            mysqli_query($conexion->conectorBD(), "INSERT INTO usuarios(usuario_nombre, usuario_apellidoP, usuario_apellidoM, usuario_email, usuario_nip, usuario_calle, usuario_colonia, usuario_estado, usuario_codigoPostal)
            VALUES ('$this->nombre', '$this->apellidoP', '$this->apellidoM', '$this->email', '$nip_encriptado', '$this->calle', '$this->colonia', '$this->estado', '$this->codigoPostal')");
            echo '<script>alert("Se a registrado correctamente.\nSu NIP es: ' . $nip_aleatorio . '")</script>';
            header('refresh:0.5; url=../index.html');
        }

        $conexion -> cerrarBD();
    }
}
?>