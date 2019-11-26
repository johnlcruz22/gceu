<?php
 include 'conexao.php';
 $nome_igreja  = $_POST['nome_igreja'];
 $endereco     = $_POST['endereco'];
 $bairro       = $_POST['bairro'];
 $obj          = new conexao;
 $connect      = $obj->conecta();
 $query_select = "SELECT nome_igreja FROM igreja WHERE nome_igreja = '$nome_igreja'";
 $logarray     = $obj->select($connect,$query_select)['array_retornado']['nome_igreja'];

 
 
  if($nome_igreja == "" || $endereco == "" || $bairro == "" ||  $nome_igreja == null || $endereco == null || $bairro == null ){

    echo"<script language='javascript' type='text/javascript'>alert('Todos os campos devem ser preenchidos');window.location.href='index.php?idpage=igr';</script>";

    }else{

      if($logarray == $nome_igreja){
        echo"<script language='javascript' type='text/javascript'>alert('Esta igreja ja possui um cadastro');window.location.href='index.php?idpage=igr';</script>";
        die();
     }else{
        $query  = "INSERT INTO igreja (nome_igreja,endereco,bairro) VALUES ('$nome_igreja','$endereco','$bairro')";
        $insert = $obj->insert($connect,$query);
    
	   
     if($insert){
        echo"<script language='javascript' type='text/javascript'>alert('Igreja cadastrada com sucesso!');window.location.href='index.php?idpage=igr'</script>";
     }else{
        echo"<script language='javascript' type='text/javascript'>alert('N�o foi poss�vel cadastrar essa igreja');window.location.href='index.php?idpage=igr'</script>";
     }
     }

    }
	
$obj->fecha_conexao($connect);
?>