<?php
session_start();
require_once "../Modelo/conexion.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Porfavor registrarse');</script>";
    header("Refresh:0 , url=index.html");
    exit();
}
$username = $_SESSION['username'];

$sql_fetch_todos = "SELECT * FROM unidades ORDER BY id_uni ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Lista de Productos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="./img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styless.css">
    <link rel="stylesheet" href="./css/fondo.css">


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

    <div class="container">
        <h1>Lista de Productos</h1>
        <h2>Has accedido como <?php echo $str = strtoupper($username) ?></h2>
    </div>
    <div class="table-product">
        <table class="table table-dark table-striped"  id="table">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Unidad</th>
                <th scope="col">Editar </th>
                <th scope="col">Eliminar</th>
            </tr>
            <tbody>
            <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        
                        <td><?php echo $row['id_uni'] ?></td>
                        <td><?php echo $row['des_uni'] ?></td>
                        <td class="modify"><a name="edit" id="" class="bfix" href="./edit/edituni.php?id=<?php echo $row['id_uni'] ?>&message=<?php echo $row['des_uni'] ?>" role="button">
                        <img src="./img/editor-de-texto.png" class="edit">
                            </a></td>
                        <td class="delete"><a name="unidad" id="" class="bdelete" href="../controlador/delete/deleteuni.php?id=<?php echo $row['id_uni'] ?>" role="button">
                        <img src="./img/eliminar.png" alt="">
                            </a></td>
                    </tr>
                <?php
                   // $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
        <a name="" id="" class="Addlist" style="float:right" href="./add/adduni.php" role="button">Agregar Producto</a>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>