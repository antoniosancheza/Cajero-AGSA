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

    private $nip;

    //Declaracion del constructor
    public function iniciarlizar($nombre, $apellidoP, $apellidoM, $email, $calle, $colonia, $estado, $codigoPostal){
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

        //Validacion si existe un usuario con ese nombre
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

    //Metodo para iniciar sesion
    public function login($conexion, $nip){
        //Encripta el nip
        $nip_encriptado = md5($nip);
        //Sentencia SQL para el login
        $login = mysqli_query($conexion ->conectorBD(), "SELECT * FROM usuarios WHERE usuario_nip = '$nip_encriptado'");
        if($log = mysqli_fetch_array($login)){
            session_start();
            $_SESSION['usuario_id'] = $log['usuario_id'];
            $_SESSION['usuario_nombre'] = $log['usuario_nombre'];
            $_SESSION['usuario_apellidoP'] = $log['usuario_apellidoP'];
            $_SESSION['usuario_saldo'] = $log['usuario_saldo'];

            header('Location: ../Vista/index_usuario.php');
        }else{
            echo '<script>alert("El NIP es incorrecto")</script>';
            header('refresh:0.5; url=../Vista/login.html');
        }
        //Se cierra la BD
        $conexion->cerrarBD();
    }


    //Metodo para realizar el deposito
    public function actualizarSaldo($conexion, $saldo, $usuario_id){
        //Sentencia SQL para actualizar el saldo
        $registro = mysqli_query($conexion->conectorBD(), "UPDATE usuarios SET usuario_saldo = usuario_saldo + $saldo WHERE usuario_id = '$usuario_id'")
        or die("mysqli_error($conexion");
        echo '<script>alert("El deposito se efectuo correctamente")</script>';
        header('refresh:0.5; url=../Vista/Depositar.php');
        //Se cierra BD
        $conexion->cerrarBD();
    }
    
    //Metodo para consultar el saldo
    public function consultarSaldo($conexion, $usuario_id){
        $usuario_saldo = 0;
        //Sentencia SQL para consultar el saldo
        $registro = mysqli_query($conexion->conectorBD(), "SELECT usuario_saldo FROM usuarios WHERE usuario_id = '$usuario_id'");
        if($registro && ($fila = mysqli_fetch_assoc($registro))) {
            $usuario_saldo = $fila['usuario_saldo'];
            echo $usuario_saldo;
        }
        $conexion->cerrarBD();
    }


    //Metodo para retirar
    public function retirar($conexion, $usuario_id, $saldo_retirar){
        //Sentencia SQL para validar que el saldo sea mayor que el saldo de la BD
        $registro = mysqli_query($conexion->conectorBD(), "SELECT * FROM usuarios WHERE usuario_saldo < $saldo_retirar");
        if ($reg = mysqli_fetch_array($registro)) {
            echo '<script>alert("Lo sentimos, no cuenta con el saldo suficiente")</script>';
            header('refresh:0.5; url=../Vista/Retirar.php');
        } else {
            //Sentencia SQL paar realizar el retiro
            mysqli_query($conexion->conectorBD(), "UPDATE usuarios SET usuario_saldo = usuario_saldo - $saldo_retirar WHERE usuario_saldo >= $saldo_retirar AND usuario_id = $usuario_id");
            echo '<script>alert("El retiro se efectuó correctamente")</script>';
            header('refresh:0.5; url=../Vista/Retirar.php');
        }
    }
}
?>