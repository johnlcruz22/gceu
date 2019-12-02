<?php
include 'conexao.php';
$obj            = new conexao;
$connect1       = $obj->conecta();
$acesso         = $_GET['acesso'];
$pos            = strpos($acesso, ';');
$email       	= substr($acesso, 0, $pos);
$valor          = substr($acesso, -1);
$id             = 0;
$query_select   = "select id from login where email='$email';";
$update         = "";

//criando a query de consulta à tabela criada
$sql = mysqli_query($connect1, $query_select) or die(
mysqli_error($connect1) //caso haja um erro na consulta
);

$id = $obj->select($connect1, $query_select)['array_retornado']['id'];

if ($id != 0){
 
  $update = "UPDATE login SET liberado='$valor' WHERE id ='$id';";
  $log    = $obj->insert($connect1, $update);

 }

$obj->fecha_conexao($connect1);
?>