
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
    if($_POST['name'] != null ){
        $sql = "INSERT INTO unidades (id_uni,des_uni) VALUES ('". trim($_POST['id_uni']). "','". trim($_POST['name']). "')";
        if($conn->query($sql)){
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Unidad Agregada',
                showConfirmButton: false,
                timer: 3000
              })
             </script>";

             $sec = "2";  
             header("Refresh: $sec , url = ../../vista/unidades.php");
            exit();

        }
        else{
            echo "<script>alert('Operacion fallida')</script>";
            header("Refresh:0 , url = ../../vista/unidades.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Porfavor completa los campos')</script>";
        header("Refresh:0 , url = ../../vista/unidades.php");
        exit();

    }
    mysqli_close($conn);
    ?>
    </body>
    </html>
   