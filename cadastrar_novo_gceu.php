<?php
 include 'conexao.php';


//AQUI GERARAM ALGUMAS COMPLICAÇÕES
  
 $nome      	= $_POST['nome'];
 $endereco      = addslashes($_POST['endereco']);
 $professor 	= $_POST['professor'];
 $anfitriao 	= addslashes($_POST['anfitriao']);
 $horario   	= $_POST['horario'];
 $semana    	= $_POST['semana'];
 $latlong       = $_POST['latlong'];
 $datacad       = date('d/m/Y');
 $data          = implode('-', array_reverse(explode('/', $datacad)));
 $obj       	= new conexao;
 $connect   	= $obj->conecta();
 $query_select  = "SELECT nome_gceu FROM gceu WHERE nome_gceu = '$nome'";
 $logarray      = $obj->select($connect,$query_select)['array_retornado']['nome_gceu'];

var_dump($nome);
var_dump($endereco);
var_dump($professor);
var_dump($anfitriao);
var_dump($horario);
var_dump($semana);
var_dump($latlong);
var_dump($datacad);
var_dump($logarray);


 
  if($nome == ""   || $endereco == ""   || $professor == ""   ||  $anfitriao == ""   || $horario == ""   ||  $semana == "" || 
     $nome == null || $endereco == null || $professor == null ||  $anfitriao == null || $horario == null ||  $semana == null)
    {
     echo"<script language='javascript' type='text/javascript'>alert('Todos os campos devem ser preenchidos');window.location.href='index.php?idpage=gce';</script>";
	}else{
      if($logarray == $nome){
        echo"<script language='javascript' type='text/javascript'>alert('Esse Nome ja existe');window.location.href='index.php?idpage=gce';</script>";
        die();
      }else{
        $query  = "INSERT INTO gceu (nome_gceu, end_gceu, prof_gceu, anfitriao_gceu, diasemana_gceu, hora_gceu, datacad, latlong) VALUES 
		                            ('$nome',     
									 '$endereco',
									 '$professor',
									 '$anfitriao',
									 '$semana',   
									 '$horario',
									 '$data',
                                     '$latlong');";
  
		$insert = $obj->insert($connect,$query);
    var_dump($insert);
	   
     if($insert)
	 {
        echo"<script language='javascript' type='text/javascript'>alert('Gceu cadastrado com sucesso!');window.location.href='index.php?idpage=gce'</script>";
     }else 
	 {
        echo"<script language='javascript' type='text/javascript'>alert('Nao foi possivel cadastrar esse Gceu');";//window.location.href='index.php?idpage=gce'</script>";
     }
     }

    }
$obj->fecha_conexao($connect);
?>