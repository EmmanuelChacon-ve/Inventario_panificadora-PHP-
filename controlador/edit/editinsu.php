
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
        if($_POST['name'] != null && $_POST['id_uni'] != null && $_POST['exi_min'] != null && $_POST['exi_max'] != null && $_POST['can_disp'] != null){
        $sql = "UPDATE insumos SET des_ins = '" . trim($_POST['name']) . "' ,id_uni = '" . trim($_POST['id_uni']) . "' ,exi_min = '" . trim($_POST['exi_min']) ."' ,exi_max = '" . trim($_POST['exi_max']) ."' ,can_disp = '" . trim($_POST['can_disp']) . "' WHERE id_ins = '" . $_POST['id'] . "'";

        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Insumo Editada',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../vista/insumos.php");
        exit();

        }
        else{
            echo "<script>alert('Inconvenientes para realizar el proceso')</script>";
            header("Refresh:0 , url =../../vista/insumos.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Por favor diligencia todos los campos')</script>";
        header("Refresh:0 , url = ../../vista/insumos.php");
        exit();

    }
    mysqli_close($conn);
?>
 </body>
    </html>
   