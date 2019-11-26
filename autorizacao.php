<?php
include 'conexao.php';
$obj            = new conexao;
$connect1       = $obj->conecta();
$acesso         = $_GET['acesso'];
$valor          = $_GET['valor'];

$query_select   = "select * from login where liberado ='$acesso';";
//echo $query_select;
//criando a query de consulta à tabela criada
$sql = mysqli_query($connect1, $query_select) or die(
mysqli_error($connect1) //caso haja um erro na consulta
);

echo "status alterado atualize a pagina \n";
echo "\n".$acesso;
echo "\n".$valor;

$obj->fecha_conexao($connect1);
?>