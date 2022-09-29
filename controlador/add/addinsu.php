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

    if($_POST['name'] != null && $_POST['id_uni'] != null && $_POST['exi_min'] != null && $_POST['exi_max'] != null && $_POST['can_dis'] != null){
        $sql = "INSERT INTO insumos (des_ins,id_uni,exi_min,exi_max,can_disp) VALUES ('". trim($_POST['name']). "','". trim($_POST['id_uni']). "', '". trim($_POST['exi_min'])."', '". trim($_POST['exi_max'])."', '". trim($_POST['can_dis'])."')";
   

        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Insumo Agregado',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../vista/insumos.php");
        exit();
        }
        else{
            echo "<script>alert('Operacion fallida')</script>";
            header("Refresh:0 , url = ../../vista/insumos.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Porfavor completa los campos')</script>";
        header("Refresh:0 , url = ../../vista/insumos.php");
        exit();

    }
    mysqli_close($conn);
?>
   </body>
    </html>
   