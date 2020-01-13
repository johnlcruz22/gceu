<?php

 include 'conexao.php';
 
 $email  = $_GET['utilizador'];
 $chave  = $_GET['confirmacao'];
 

 ini_set('default_charset', 'UTF-8');
 $obj          = new conexao;
 $connect      = $obj->conecta();
 $query_select = "select * from recuperacao where utilizador='$email' and confirmacao='$chave'";
 $logarray     = $obj->select($connect,$query_select)['array_retornado']['utilizador'];
 
 
  if($logarray){

   $linkauto = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $limpa    =  substr($linkauto, 0, strpos($linkauto,"forgot"));
   $link     = "$limpa"."recuperar.php?utilizador=$email&confirmacao=$chave";
   header("Location: recpass1.php?email=$email");  
  }
  else{
   echo "<script language='javascript' type='text/javascript'>alert('Falha ao confirmar link, tente novamente.');window.location.href='forgot-password.html';</script>";
  }

 

$obj->fecha_conexao($connect);


?>