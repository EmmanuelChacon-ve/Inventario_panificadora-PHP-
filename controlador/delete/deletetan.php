
<?php
    session_start();
    require_once "../../Modelo/conexion.php";
    if ($_SESSION['username'] == null){
        echo "<script>alert('Favor ingresar con tus credenciales')</script>";
        header("Refresh:0 , url = ../../index.html");
        exit();

    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <?php
    $delete_num2 = $_GET['id'];
    $sql_delete2 =  "DELETE FROM tandas WHERE id_tan = '$delete_num2'";
    $query_delete2 = mysqli_query($conn,$sql_delete2);

    if(!$query_delete2){
        echo "<script>
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'La Tanda No Puso Ser Eliminado',
        
        showConfirmButton: false,
        timer: 5000
      })
     </script>";

     $sec = "4";  
     header("Refresh: $sec , url = ../../vista/list.php");
    exit();
    }
    else{
        echo "<script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Tanda Eliminada',
        showConfirmButton: false,
        timer: 3000
      })
     </script>";

     $sec = "2";  
     header("Refresh: $sec , url = ../../vista/tandas.php");
    exit();

    }

    mysqli_close($conn);

?>
</body>
</html>