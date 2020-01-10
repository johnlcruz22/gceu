<?php

 include 'conexao.php';
 
 $email  = $_GET['utilizador'];
 $chave  = $_GET['confirmacao'];
 
 var_dump($email);
 var_dump($chave);

 ini_set('default_charset', 'UTF-8');
 $obj          = new conexao;
 $connect      = $obj->conecta();
 $query_select = "select * from recuperacao where utilizador='$email' and confirmacao='$chave'";
 $logarray     = $obj->select($connect,$query_select)['array_retornado']['utilizador'];
 
 var_dump($logarray);

  if($logarray){

   $linkauto = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   var_dump($linkauto);
   $limpa =  substr($linkauto, 0, strpos($linkauto,"forgot"));
   $link     = "$limpa"."recuperar.php?utilizador=$email&confirmacao=$chave";
   header("Location: recpass.html?email=$email");  
  }
  else{
   echo "FALHA AO CONFIRMAR USUARIO OU CHAVE DE SEGURANÇA";
  }

 

$obj->fecha_conexao($connect);


?>