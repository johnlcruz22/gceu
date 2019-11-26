<?php

 class conexao
 {
	 
//____________________________________________________________________________________________________
 
     public function conecta() // FUNCAO CONECTA AO BANCO
      { 
	   $ini      = parse_ini_file('conexao.ini');
	   $porta_ip = $ini['portaip'];
	   $host     = $ini['host'];
	   $senha    = $ini['senha'];
	   $database = $ini['database'];

	   ini_set('default_charset', 'UTF-8');
	   $mysqli   = new mysqli($porta_ip,$host, $senha, $database);
	   $mysqli->query("SET NAMES utf8");
  
      if($mysqli->connect_errno)
		{
		 echo "Desculpe, nao foi possivel conectar ao banco de dados";
		 echo "Erro: Conexão falhou verifique o erro abaixo \n";
		 echo "Erro: " . $mysqli->connect_errno . "\n";
		 echo "Erro: " . $mysqli->connect_error . "\n";
    
         exit;
        }
  
       return $mysqli;
      }
//_________________________________________________________________________________________


     public function insert($conexao,$str_insert) // FAZ INSERT
	 {
    		 
	   if ($insert = mysqli_query($conexao,$str_insert)) {
		  return true;  
	    }
       else{
		    return false;
	    }
	 }

	 public function select($conexao,$str_select) //FAZ SELECT
	 {
	  if ($result = mysqli_query($conexao, $str_select)) {
		$linha  = mysqli_fetch_array($result);
		$qtde   = mysqli_num_rows($result);
		$array  = array('array_retornado' => $linha, 'result_query' => $result, 'qtde_linhas' => $qtde);
		return $array;
	   }
      else {
		echo "Erro: " . $mysqli->error . "\n";
	  }	  
		  
	 }
	
     public function fecha_conexao($conexao) //FAZ SELECT
	 {
	  if (mysqli_close($conexao)) {
		 return null;
	   }
      else {
		echo "Erro: " . $mysqli->error . "\n";
	  }	  

	 }
 }
 
 

?>