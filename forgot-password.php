<?php

 include 'conexao.php';
 require_once('class.phpmailer.php'); //chama a classe de onde você a colocou.

 $obj          = new conexao;
 $connect      = $obj->conecta();
 $email        = $_POST['inputEmail'];
 $query_select = "select * from login where email='$email';";
 $logarray     = $obj->select($connect,$query_select)['array_retornado']['nome'];
 

 
 
  if($logarray != ''){
     $chave = sha1(uniqid( mt_rand(), true));
     $conf  = "INSERT INTO recuperacao (utilizador, confirmacao) VALUES ('$email', '$chave')";
     
     $return= $obj->INSERT($connect, $query_select);
     var_dump($return);
     var_dump($logarray);
     
    
    if($return){

        $link = "http://example.net/recuperar.php?utilizador=$logarray&confirmacao=$chave";


$mail = new PHPMailer(); // instancia a classe PHPMailer
$mail->IsSMTP();
$mail->SMTPDebug =  3;
$mail->SMTPAuth = true;


//configuração do gmail
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com'; 
$mail->Port = '465'; //porta usada pelo gmail.
$mail->IsHTML(true); 
$mail->Mailer = 'smtp'; 


//configuração do usuário do gmail
$mail->SMTPAuth = true; 
$mail->Username = 'john.lcruz22@gmail.com'; // usuario gmail.   
$mail->Password = '(Debora2204)'; // senha do email.

$mail->SingleTo = true; 
$mail->From = $logarray; 
$mail->FromName = "Nome do remetente."; 

$mail->addAddress($email); // email do destinatario.
$mail->Subject = "Recuperação de password"; 
$mail->Body = "Olá $logarray, visite este link $link";

var_dump($mail);

if(!$mail->Send())
    echo "Erro ao enviar Email:" . $mail->ErrorInfo;


  // configuração do email a ver enviado.
 
        
          echo '<p>Foi enviado um e-mail para o seu endereço, onde poderá encontrar um link único para alterar a sua password</p>';
 
          echo '<p>Houve um erro ao enviar o email (o servidor suporta a função mail?)</p>';
 
        
 
    // Apenas para testar o link, no caso do e-mail falhar
    echo '<p>Link: '.$link.' (apresentado apenas para testes; nunca expor a público!)</p>';
   
    }else{

    }


    }else{
      echo "USUARIO INVÁLIDO";
    }
  
$obj->fecha_conexao($connect);


?>