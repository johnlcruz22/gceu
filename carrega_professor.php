<?php
include 'conexao.php';
$obj            = new conexao;
$connect1       = $obj->conecta();
$id_estado      = $_GET['estado'];
$query_select   = "select * from gceu where nome_gceu ='$id_estado';";
//echo $query_select;
//criando a query de consulta à tabela criada
$sql = mysqli_query($connect1, $query_select) or die(
mysqli_error($connect1) //caso haja um erro na consulta
);


while($aux = mysqli_fetch_assoc($sql)) {
    echo "<option>". $aux['prof_gceu']. "</option>";
}



$obj->fecha_conexao($connect1);
?>