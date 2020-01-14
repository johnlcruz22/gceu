<?php

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP;
 
 include 'conexao.php';
 require 'phpmailer/src/PHPMailer.php';
 require 'phpmailer/src/SMTP.php';
 require 'phpmailer/src/Exception.php';
 
 $ini      = parse_ini_file('enviar_email.ini');
 $emailenv = $ini['email'];
 $senhaenv = $ini['senha'];
 var_dump($emailenv);
 var_dump($senhaenv);
 
 ini_set('default_charset', 'UTF-8');
 $obj          = new conexao;
 $connect      = $obj->conecta();
 $email        = $_POST['inputEmail'];
 $query_select = "select * from login where email='$email';";
 $logarray     = $obj->select($connect,$query_select)['array_retornado']['nome'];
 

  if($logarray){
     $chave    = sha1(uniqid( mt_rand(), true));
     $conf     = "INSERT INTO recuperacao (utilizador, confirmacao) VALUES ('$email', '$chave')";
     
     $return   = $obj->INSERT($connect, $conf);

  if($return){

  $linkauto = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  $limpa    =  substr($linkauto, 0, strpos($linkauto,"forgot"));
  $link     = "$limpa"."recuperar.php?utilizador=$email&confirmacao=$chave";
  $inicial  = "$limpa"."login.html";
  
  $mail = new PHPMailer(); // instancia a classe PHPMailer
  $mail->IsSMTP();
  $mail->SMTPDebug  =  3;
  $mail->SMTPAuth   = true;

//configuração do gmail
  $mail->SMTPSecure = 'ssl';
  $mail->Host       = 'smtp.gmail.com'; 
  $mail->Port       = '465'; //porta usada pelo gmail.
  $mail->IsHTML(true); 
  $mail->Mailer     = 'smtp'; 

//configuração do usuário do gmail
  $mail->SMTPAuth   = true; 
  $mail->Username   = $emailenv; // usuario gmail.   
  $mail->Password   = $senhaenv; // senha do email.

  $mail->SingleTo   = true; 
  $mail->From       = 'Recuperacao@gceu.com'; 
  $mail->FromName   = "RecuperacaoGCEU"; 

  $mail->addAddress($email); // email do destinatario.
  $mail->Subject    = utf8_decode("Recuperação de password"); 
  $mail->Body       = utf8_decode("Olá $logarray, visite este link $link para alterar sua senha de acesso");


  if(!$mail->Send()){
    echo "Erro ao enviar Email:" . $mail->ErrorInfo;
    // configuração do email a ver enviado.
    //echo '<p>Foi enviado um e-mail para o seu endereço, onde poderá encontrar um link único para alterar a sua password</p>';
    //echo '<p>Houve um erro ao enviar o email (o servidor suporta a função mail?)</p>';
   // Apenas para testar o link, no caso do e-mail falhar
    //echo '<p>Link: '.$link.' (apresentado apenas para testes; nunca expor a público!)</p>';
    }
   else{
    $limpa =+ "login.html";
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Você recebera um e-mail em pouco tempo verifique também a caixa de spam.');
    window.location.href='$inicial';
    </SCRIPT>");
    } 
   }
   echo "FALHA AO GERAR CHAVE DE SEGURANÇA FALE COM O SUPORTE";
  }
  else{
      echo "USUARIO INVÁLIDO";
    }
  
$obj->fecha_conexao($connect);


?>