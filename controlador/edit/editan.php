<?php
    session_start();
    require_once "../../Modelo/conexion.php";
    if($_SESSION['username'] == null){
    echo "<script>alert('Please login.')</script>";
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
        if($_POST['fecha'] != null && $_POST['pan'] != null && $_POST['cantidad'] != null ){
        $sql = "UPDATE tandas SET fec_tan = '" . trim($_POST['fecha']) . "' ,id_pan = '" . trim($_POST['pan']) . "' ,can_pie = '" . trim($_POST['cantidad']) . "' WHERE id_tan = '" . $_POST['id'] . "'";

        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Tanda Editada',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../vista/tandas.php");
        exit();

        }
        else{
            echo "<script>alert('Inconvenientes para realizar el proceso ,no se esta colocando el id del producto correcto')</script>";
            header("Refresh:0 , url =../../vista/tandas.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Por favor diligencia todos los campos')</script>";
        header("Refresh:0 , url = ../../vista/tandas.php");
        exit();

    }
    mysqli_close($conn);
?>
 </body>
    </html>
   
