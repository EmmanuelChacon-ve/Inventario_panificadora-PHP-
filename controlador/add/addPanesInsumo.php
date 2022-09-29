 <?php
    
    // Incluir archivo de conexion a la base de datos
    // Definir variable e inicializar con valores vacio
    $pan = $insumo = $cantidad = $unidadMedida =  "";
    $pan_err = $insumo_err = $cantidad_err = $unidadMedida_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //validando pan;
        //si la variable si llega
        if(isset($_POST['select'])){
            if($_POST['select'] != 0){
                $pan = $_POST['select'];
            }else{
                echo json_encode('seleccione un pan');
                header("Refresh: 0 , url = ../vista/insertInsumo.php");
                exit();
            }
        }
        //validando insumo
        if(isset($_POST['insumos'])){
            if($_POST['insumos'] == 0){
                echo json_encode('seleccione un insumo');
                header("Refresh: 0 , url = ../vista/insertInsumo.php");
                exit();
            }else{
                $insumo = $_POST['insumos'];
            }
        }
        //validando cantidad
        if(isset($_POST['medida'])){
            $aux = intval($_POST['medida']);
            if(!empty(trim($_POST["medida"]))){
                $medida = $_POST['medida'];             
            }else{
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Rellene la medida!',
                  })
                </script>";    

                header("Refresh: 2 , url = ../vista/insertInsumo.php");
                exit();
            }
        }

        if(isset($_POST['id-medida'])){
            if(!empty(trim($_POST["id-medida"]))){
                $id_medida = $_POST['id-medida'];
            }else{
                echo 'id-medida vacio';
                header("Refresh: 0 , url = ../vista/insertInsumo.php");
                exit();
            }
        }
        if ($pan != null && $insumo != null && $medida != null && $id_medida != null){
            $sql = "INSERT INTO panes_insumos (id_pan,id_ins,can_ins,id_uni) VALUES ($pan,$insumo,$medida,$id_medida)";
                if(mysqli_query($conn,$sql)){
                    echo "<script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '¡Ha sido editado exitosamente!',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    </script>";
                    header("Refresh: 2 , url = ../vista/pan_insumos.php");
                    exit();
                }else{
                    echo json_encode('error' . $sql . "<br>" . mysqli_error($conn));
                } 
        }
    }
?> 