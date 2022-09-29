<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="js/insertInsumos.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/insertar.css">
    <link rel="stylesheet" href="./css/pan_insu.css">
    <link rel="stylesheet" href="./css/styless.css">
    <link rel="stylesheet" href="./css/fondo.css">
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
        <span>Mejora la receta</span>
        <form action="" method="post">
        <div class="selects">
        <div class="select-principal">
            <label for="pan-actual">Pan</label>
            <select name="select" class="select principal" id='pan-actual'>
                <option value="0">seleccione</option>
            </select>
        </div>
        <div class="select-insumo">
            <label for="select">Insumo a agregar</label>
            <select name="insumos" class="insumosAgregar" id="select">
                <option value="0">seleccione</option>
            </select>
        </div>
        <div class="medida">
                <input type="text" name="medida" id="medida" placeholder='cantidad en ' onblur='soloNumeros(value)' class="fn">
                <input type="hidden" name="id-medida" value='' id='id-medida'>
        </div>
    </div>
    <div class="botones-insumos">
        <input type="submit" value="Agregar" class="button" id="agg">    
    
        </div>
    
</form>
<a href="pan_insumos.php" name='prueba'><button class="button" id="agg">Volver a panes</button></a>

    </section>
</body>
</html>

<?php
    session_start();
    require_once "../Modelo/conexion.php";
    require_once "../controlador/add/addPanesInsumo.php";
    if ($_SESSION['username'] == null) {
        echo "<script>alert('Porfavor registrarse');</script>";
        header("Refresh:0 , url=index.html");
        exit();
    }
?>