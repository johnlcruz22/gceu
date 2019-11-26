<?php
include 'conexao.php';

$nome           = $_POST['nome'];
$gceu           = $_POST['gceu'];
$duvida         = $_POST['duvida'];
$datatmp        = $_POST['data'];
$data           = implode('-', array_reverse(explode('/', $datatmp)));
$professor      = $_POST['professor'];
$obj            = new conexao;
$connect      = $obj->conecta();

if($nome == "" || $gceu == "" || $data == "" || $duvida == "" || $professor == "" ||
   $nome == null || $gceu == null || $data == null || $duvida == null || $professor == null) {

    echo"<script language='javascript' type='text/javascript'>alert('Todos os campos devem ser preenchidos');window.location.href='index.php?idpage=duv';</script>";

}else{
        $query  = "insert into duvidas (nome_aluno, gceu, duvida, data_duvida, professor) values     ('$nome',         
                                                                                                      '$gceu',
                                                                                                      '$duvida',         
                                                                                                      '$data',         
                                                                                                      '$professor');";

        $insert = $obj->insert($connect,$query);

        if($insert){
            echo"<script language='javascript' type='text/javascript'>alert('Duvida cadastrada com sucesso!');window.location.href='index.php?idpage=duv'</script>";
        }else{
            echo"<script language='javascript' type='text/javascript'>alert('Năo foi possível cadastrar essa duvida');window.location.href='index.php?idpage=duv'</script>";
        }
    }

$obj->fecha_conexao($connect);
?>