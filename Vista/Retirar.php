<?php
session_start(); //Inicia la sesion
//Se valida que haya un sesion iniciada
if (isset($_SESSION['usuario_nombre']) && isset($_SESSION['usuario_apellidoP'])) {
    $usuario_nombre = $_SESSION['usuario_nombre'];
    $usuario_apellidoP = $_SESSION['usuario_apellidoP'];
    $usuario_id = $_SESSION['usuario_id'];
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
    <link rel="stylesheet" href="../Recursos/CSS/estilos-retirar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Banco - Bienvenida</title>
</head>

<body>
    <main>
        <div class="card-main">
            <h2 class="main-subtitulo">
                <?php echo $usuario_nombre; ?> tu saldo actual es de: $
                <?php
                require("../Modelo/Cajero.php");
                $Consulta = new Cajero();
                $Consulta->consultarSaldo($conexion, $usuario_id);
                ?>
            </h2>
            <div class="input-desposito">
                <form action="../Control/CajeroControl.php" method="post">
                    <label class="desposito_label">Por favor, ingrese la cantidad a retirar.</label><br>
                    <input class="desposito_input" type="number" name="saldo_retirar" required><br>
                    <input type="hidden" name="option" value="4">
                    <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
                    <div class="deposito_enlaces">
                        <input class="desposito_submit bg-success" type="submit" value="Retirar">
                        <a href="index_usuario.php"><button type="button"
                                class="desposito_cancelar btn btn-danger">Cancelar</button></a>
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