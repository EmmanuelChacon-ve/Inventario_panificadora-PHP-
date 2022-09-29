<?php
    require_once "../../Modelo/conexion.php";
    $aux = "";
    if(isset($_POST['id'])){
        $aux = intval($_POST['id']);
        if($aux != 0){
        $id     = $aux;
        }else{
            exit();
        }
    }else{
        exit();
    }
    if(isset($_POST['nueva-medida'])){
        $aux = intval($_POST['nueva-medida']);
        if($aux != 0){
            $medida = $aux;
        }else{
            exit();
        }
    }else{
        exit();
    }
    $sql = "UPDATE panes_insumos SET can_ins = '$medida' WHERE id_panins = '$id'";
    if($conn->query($sql)){
        echo json_encode(true);
        header("Refresh:0 , url =../vista/pan_insumos.php");
        exit();

    }
    else{
        echo json_encode(false);
        header("Refresh:0 , url =../vista/pan_insumos.php");
        exit();

    }
    
?>
