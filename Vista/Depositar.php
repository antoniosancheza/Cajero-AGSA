<?php
session_start(); //Inicia la sesion
//Se valida que haya un sesion iniciada
if (isset($_SESSION['usuario_nombre']) && isset($_SESSION['usuario_apellidoP'])) {
    $usuario_nombre = $_SESSION['usuario_nombre'];
    $usuario_apellidoP = $_SESSION['usuario_apellidoP'];
    $usuario_saldo = $_SESSION['usuario_saldo'];
} else {
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
    <link rel="stylesheet" href="../Recursos/CSS/estilos-deposito.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Banco - Bienvenida</title>
</head>

<body>
    <main>
        <div class="card-main">
            <h1 class="main-titulo">¡Hola,
                <?php echo $usuario_nombre ?>!.
            </h1>
            <h2 class="main-subtitulo">Su saldo actual es de: $<?php echo $usuario_saldo?></h2>
            <div class="input-desposito">
                <form action="" method="post">
                    <label class="desposito_label">Ingrese la cantidad a depositar</label><br>
                    <input class="desposito_input" type="number" name="desposito"><br>
                    <input type="hidden" name="option" value="3">
                    <div class = "deposito_enlaces">
                        <input class="desposito_submit bg-success" type="submit" value="Depositar">
                        <button type="button" class="desposito_cancelar btn btn-danger" href="index_usuario.php">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>