<?php
 include 'conexao.php';
 $nome         = $_POST['nome'];
 $endereco     = $_POST['endereco'];
 $gceu         = $_POST['gceu'];
 $idade        = $_POST['idade'];
 $sexo         = $_POST['sexo'];
 $status       = $_POST['status'];
 $apoio        = $_POST['apoio'];
 $igreja       = $_POST['igreja'];
 $datacad       = date('d/m/Y');
 $data          = implode('-', array_reverse(explode('/', $datacad)));
 $query_select = "SELECT nome,endereco FROM aluno WHERE nome = '$nome' and endereco= '$endereco'";
 $obj          = new conexao;
 $connect      = $obj->conecta();
 $logarray     = $obj->select($connect,$query_select)['array_retornado']['nome'];
 $logarray2    = $obj->select($connect,$query_select)['array_retornado']['endereco'];

 
 
  if($nome == "" || $endereco == "" || $nome == null || $endereco == null ){

    echo"<script language='javascript' type='text/javascript'>alert('Todos os campos devem ser preenchidos');window.location.href='index.php?idpage=alu';</script>";

    }else{

      if($logarray == $nome && $logarray2 == $endereco ){
        echo"<script language='javascript' type='text/javascript'>alert('Este aluno ja possui cadastro');window.location.href='index.php?idpage=alu';</script>";
        die();
     }else{
        $query  = "INSERT INTO aluno (nome, endereco, gceu, idade, sexo, status_aluno, apoio, igreja, datacad) VALUES ('$nome',         
                                                                                                                       '$endereco',
                                                                                                                       '$gceu',         
                                                                                                                       '$idade',        
                                                                                                                       '$sexo',         
                                                                                                                       '$status',       
		                                                                                                               '$apoio',
		                                                                                                               '$igreja',
		                                                                                                               '$data');";
        $insert = $obj->insert($connect,$query);
    
	   
     if($insert){
        echo"<script language='javascript' type='text/javascript'>alert('Aluno cadastrado com sucesso!');window.location.href='index.php?idpage=alu'</script>";
     }else{
        echo"<script language='javascript' type='text/javascript'>alert('Năo foi possível cadastrar essa aluno');window.location.href='index.php?idpage=alu'</script>";
     }
     }

    }
	
$obj->fecha_conexao($connect);
?>