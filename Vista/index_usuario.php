<?php
session_start(); //Inicia la sesion
//Se valida que haya un sesion iniciada
if(isset($_SESSION['usuario_nombre']) && isset($_SESSION['usuario_apellidoP'])){
    $usuario_nombre = $_SESSION['usuario_nombre'];
    $usuario_apellidoP = $_SESSION['usuario_apellidoP'];
    $usuario_saldo = $_SESSION['usuario_saldo'];
}else{
    //Sino hay una sesion iniciada direcciona al index
    header('Location: ../index.html');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../Recursos/CSS/estilos-index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Banco - Bienvenida</title>
</head>

<body>
    <main>
        <div class="card-main">
            <div class="boton_salir">
                <a href="Salir.php"><i class="bi bi-box-arrow-left"></i> Salir</a>
            </div>
            <h1 class="main-titulo">¡Hola, <?php echo $usuario_nombre?>! Bienvenido.</h1>
            <h2 class="main-subtitulo">¿Qué deseas realizar el día de hoy?</h2>
            <div class="enlaces">
                <div class="enlace-retirar bg-success">
                    <a href="Vista/login.html"><i class="bi bi-cash-coin"></i> Retirar</a>
                </div>
                <div class="enlace-depositar bg-danger">
                    <a href="Depositar.php"><i class="bi bi-arrow-down-up"></i> Depositar</a>
                </div>
                <div class="enlace-nuevaTrajeta bg-primary">
                    <a href="Vista/solicitarTarjeta.html"><i class="bi bi-credit-card-2-back-fill"></i> Solicitar
                        tarjeta</a>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>