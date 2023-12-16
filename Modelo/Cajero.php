<?php

include ("ConexionBD.php");
class Cajero{

    //Cracion de variables
    private $nombre;
    private $apellidoP;
    private $apellidoM;
    private $email;
    private $nip;
    private $calle;
    private $colonia;
    private $estado;
    private $codigoPostal;

    //Declaracion del constructor
    public function __construct($nombre, $apellidoP, $apellidoM, $email, $nip, $calle, $colonia, $estado, $codigoPostal){
        $this -> nombre = $nombre;
        $this -> apellidoP = $apellidoP;
        $this-> apellidoM = $apellidoM;
        $this -> email = $email;
        $this -> nip = $nip;
        $this -> calle = $calle;
        $this -> colonia = $colonia;
        $this -> estado = $estado;
        $this-> codigoPostal = $codigoPostal;
    }


    //Metodo para crar nuevos usuarios o tarjetas
    public function crearUsuario(){
        //Crecion de variables para el metodo
        $nip_aleatorio = rand(1, 9);
        $this->nip = $nip_aleatorio;
        $nip_encriptado = md5($this->nip);

        //Validacion si existe un usuario con ese correo
        $registro = mysqli_query($this ->conectorBD(), "SELECT 'email' FROM usuarios WHERE email = '$this->email'");
        if($reg = mysqli_fetch_array($registro)){
            echo "El email ya existe";
            header('Location: ../Vista/solicitarTarjeta.html');
        }else{
            //Crecion del nuevo usuario
            msqli_query($this->conectorBD(), "INSERT INTO usuarios(usuario_nombre, usuario_apellidoP, ususario_apellidoM, usuario_email, usuario_nip, usuario_calle, usuario_colonia, usuario_estado, usuario_codigoPostal)
            VALUES ('$this->nombre', '$this->apellidoP', '$this->apellidoM', '$this->email', '$nip_encriptado', '$this->calle', '$this->colonia', '$this->estado', '$this->codigoPostal')");
            alert("Se a registrado correctamente.\nSu NIP es: ". $nip_aleatorio);
        }
    }
}
?>