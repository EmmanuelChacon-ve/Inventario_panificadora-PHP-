
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"><script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/pan_insu.css">
    <link rel="stylesheet" href="./css/styless.css">
    <link rel="stylesheet" href="./css/fondo.css">
    <script defer src="js/app.js"></script>
    <title>Panes insumos</title>
</head>
<body>
<header class="header" >
        <div class="logo">
            <img src="./img/logo.png" alt="">
        </div>
        <nav>
            <ul class="nav__links">
            <li><a href="list.php">Panes</a></li>
                <li><a href="insumos.php">insumos</a></li>
                <li><a href="unidades.php">unidades</a></li>
                <li><a href="pan_insumos.php">Pan insumos</a></li>
                <li><a href="tandas.php">tandas</a></li>
                <li><a name="" id="" class="button-logout" href="../controlador/logout.php" role="button">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <section class="pan-insumo">
        <span>Que pan deseas preparar el dia de hoy</span>
        <div class="selects">
        <div class="select-principal">
            <select name="pan-select" class="select principal">
                <option value="0">seleccione</option>
            </select>
        </div>
        <div class="select-secundario">
            <select name="select" class="insumo select
            " id="select">
                <option value="0">seleccione</option>
            </select>
        </div>
        </div>
        <div class="disponible"></div>
        <div class="utilidad">
            <a href="insertInsumo.php"><button class='agregar button'>Agregar Insumo</button></a>
            <button class="button editarButton">Editar</button>
            <!-- <button class="agregar button"><a href="insertInsumo.html">insert</a></button> -->
            <form action="" method="post">
                <input type="hidden" name="id_registro" value='' id='id_registro'>
                <input type="submit" class='quitar  button' value="eliminar">
            </form>
        </div>
        <div class="editar">
            <form action="" method="POST" class='editar-form'>
                <div class="enviar">
                    <!-- <input type="hidden" name="id-medida" value='' id='id_registro'> -->
                    <input type="text" name="nueva-medida" id="" class='valor-nuevo'>
                </div>
                <div class="boton">
                    <input type="submit" value="Editar insumo" class="button2">
                </div>
            </form>
        </div>
    </section>
</body>
</html>

<?php
session_start();
    require_once "../Modelo/conexion.php";
    require_once "../controlador/delete/deleteInsumo.php";

    require_once "../Modelo/conexion.php";
    if ($_SESSION['username'] == null) {
        echo "<script>alert('Porfavor registrarse');</script>";
        header("Refresh:0 , url=index.html");
        exit();
    }
?>

<!-- <form action="editarInsumo.php" method="POST">
                <input type="hidden" name="id-medida" value='' id='id_registro'>
                <input type="submit" value="Editar insumo" class="button">
            </form> -->