
<?php
session_start();
require_once "../Modelo/conexion.php";

$sql_fetch_todos = "SELECT * FROM panes ORDER BY id_pan ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
$data = [];

while ($item = mysqli_fetch_array($query)){
    $data[] = [
        'id' => $item['id_pan'],
        'nombre' => $item['des_pan']
    ];
}
array_push($data,sizeof($data));
// echo json_encode($data);

$sql_fetch_todos2 = "SELECT * FROM panes_insumos ORDER BY id_panins ASC";
$query2 = mysqli_query($conn, $sql_fetch_todos2);
$data2 = [];

while ($item = mysqli_fetch_array($query2)){
    $data2[] = [
        'registro' => $item['id_panins'],
        'id' => $item['id_pan'],
        'nombre' => $item['id_ins'],
        'cantidad' => $item['can_ins'],
    ];
}
array_push($data2,sizeof($data2));
// echo json_encode($data2);

$sql_fetch_todos3 = "SELECT * FROM insumos ORDER BY id_ins ASC";
$query3 = mysqli_query($conn, $sql_fetch_todos3);
$data3 = [];

while ($item = mysqli_fetch_array($query3)){
    $data3[] = [
        'id' => $item['id_ins'],
        'nombre' => $item['des_ins'],
        'unidad' => $item['id_uni'],
        'disp'   => $item['can_disp']
    ];
}

array_push($data3,sizeof($data3));

$sql_fetch_todos4 = "SELECT * FROM unidades ORDER BY id_uni ASC";
$query4 = mysqli_query($conn, $sql_fetch_todos4);
$data4 = [];

while ($item = mysqli_fetch_array($query4)){
    $data4[] = [
        'id' => $item['id_uni'],
        'nombre' => $item['des_uni'],
    ];
}

array_push($data4,sizeof($data4));

$datos[] = array_merge($data,$data2,$data3,$data4);

echo json_encode($datos);

?>