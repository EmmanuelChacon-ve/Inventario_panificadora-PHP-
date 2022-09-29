
<?php
session_start();
require_once "../../Modelo/conexion.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.');</script>";
    header("Refresh:0 , url=../../index.html");
}
$username = $_SESSION['username'];
$sql_fetch_todos = "SELECT * FROM insumos ORDER BY id_ins ASC";
$query = mysqli_query($conn, $sql_fetch_todos);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Agregar Producto</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styless.css">
    <link rel="stylesheet" href="../css/edits.css">
    <link rel="stylesheet" href="../css/fondo.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="../js/addlist3.js"></script>
    <script defer src="../js/idMedida.js"></script>

</head>

<body>
<header class="header" >
        <div class="logo">
            <img src="../img/logo.png" alt="">
        </div>
        <nav>
            <ul class="nav__links">
            <li><a href="../list.php">Panes</a></li>
                <li><a href="../insumos.php">insumos</a></li>
                <li><a href="../unidades.php">unidades</a></li>
                <li><a href="../pan_insumos.php">Pan insumos</a></li>
                <li><a href="../tandas.php">tandas</a></li>
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
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">ID: unidad de medida</th>
                <th scope='col'>Existencia minima</th>
                <th scope='col'>Existencia maxima</th>
                <th scope='col'>Cantidad disponible</th>
                </tr>
            </thead>
            <tbody>
                <?php
     
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                 
                        <td><?php echo $row['id_ins'] ?></td>
                        <td><?php echo $row['des_ins'] ?></td>
                        <td><?php echo $row['id_uni'] ?></td>
                        <td><?php echo $row['exi_min'] ?></td>
                        <td><?php echo $row['exi_max'] ?></td>
                        <td><?php echo $row['can_disp'] ?></td>
                    </tr>
                <?php
           
                } ?>
            </tbody>
        </table>
        <br>
        <div class="addproduct">
            <form method="POST" action="../../controlador/add/addinsu.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del Insumo</label>
                    <br>
                    <input type="text" class="form-control" name="name" onblur="validacion(value,this)">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Unidad de medida</label>
                    <br>
                    <!-- <input type="text" class="form-control" name="id_uni" onblur="validacion2(value,this)"> -->
                    <select name="id_uni" id="id_unidad" class="form-select" aria-label="Default select example">
                        <option value="0">Seleccione</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Existencia Minima</label>
                    <br>
                    <input type="text" class="form-control" name="exi_min" id="minima"onblur="validacion2(value,this)">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Existencia Maxima</label>
                    <br>
                    <input type="text" class="form-control" name="exi_max" id="maxima"onblur="validacion2(value,this)">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Cantidad Disponible</label>
                    <br>
                    <input type="text" class="form-control" name="can_dis" id="disponible"onblur="validacion2(value,this)">
                </div>
                <br>
                <div class="form-button">
               
                    <button type="submit" class="modify" style="float:right">Agregar Producto</button>
                    
                    <a name="" id="" class="return" href="../insumos.php" role="button" style="float:left">Volver</a>
                </div>
            </form>
        </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>