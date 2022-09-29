
<?php
session_start();
require_once "../../Modelo/conexion.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.');</script>";
    header("Refresh:0 , url=../../index.html");
}
$username = $_SESSION['username'];
$sql_fetch_todos = "SELECT * FROM tandas ORDER BY id_tan ASC";
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
    <script defer src="../js/tandas.js"></script>
    <script defer src="../js/addlist2.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <li><a href="../pan_insumos.php">Pan Insumos</a></li>
                <li><a href="../tandas.php">Tandas</a></li>
                <li><a name="" id="" class="button-logout" href="../../controlador/logout.php" role="button">Cerrar Sesión</a></li>
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
                <th scope="col">fecha</th>
                <th scope="col">Id Del pan</th>
                <th scope='col'>Cantidad de la tanda</th>
                </tr>
            </thead>
            <tbody>
                <?php
     
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                          
                    <td><?php echo $row['id_tan'] ?></td>
                        <td><?php echo $row['fec_tan'] ?></td>
                        <td><?php echo $row['id_pan'] ?></td>
                        <td><?php echo $row['can_pie'] ?></td>

                    </tr>
                <?php
           
                } ?>
            </tbody>
        </table>
        <br>
        <div class="addproduct">
            <form method="POST" action="../../controlador/add/addtan.php">
                <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Fecha</label>
                    <br>
                    <input type="text" class="form-control" name="fecha" required>

                </div> -->
                <div class="form-group">
                    <label for="id">id del pan</label>
                    <br>
                    <!-- <input type="text" class="form-control" name="pan" required> -->
                    <select name="pan" id="id" class="form-select" aria-label="Default select example">
                        <option value="0">seleccione</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">cantidad de la tanda</label>
                    <br>
                    <input type="text" class="form-control" name="cantidad" onblur = "validacion2(value,this)">
                    
                </div>
                <br>
                <div class="form-button">
               
                    <button type="submit" class="modify" style="float:right">Agregar Producto</button>
                    
                    <a name="" id="" class="return" href="../tandas.php" role="button" style="float:left">Volver</a>
                </div>
            </form>
        </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>