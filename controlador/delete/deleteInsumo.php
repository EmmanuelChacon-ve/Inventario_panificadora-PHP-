
<?php
        // require_once "../Modelo/conexion.php";
        $id = '';
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['id_registro'])){
                if($_POST['id_registro'] != 0){
                    $id = $_POST['id_registro'];
                }else{
                    echo 'no hay insumos';
                    exit();
                }
            }
            $sql_delete =  "DELETE FROM panes_insumos WHERE id_panins = '$id'";
            $query_delete = mysqli_query($conn,$sql_delete);
            if(!$query_delete){
                echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se pudo eliminar!'
                  })
                </script>";    
                exit();
            }
            else{
                echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Producto Eliminado',
                    showConfirmButton: false,
                    timer: 2000})
                    
                </script>";
            }
        }
?>
