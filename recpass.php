<?php
include 'conexao.php';

$email        = $_GET['email'];
$senha        = MD5($_POST['senha']);
$obj          = new conexao;
$connect      = $obj->conecta();
$query_select = "SELECT email FROM login WHERE email = '$email'";
$logarray     = $obj->select($connect, $query_select)['array_retornado']['email'];

var_dump($email);
var_dump($logarray);


   /* if ($logarray == $email) {
        echo "<script language='javascript' type='text/javascript'>alert('Esse email já existe');window.location.href='register.html';</script>";
        die();
    } else {
        $query = "INSERT INTO login  (nome, sobrenome, senha, email, liberado) VALUES 
                                     ('$nome','$sobrenome','$senha','$email','0')";
        $insert = $obj->insert($connect, $query);

        if ($insert) {
            echo "<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='register.html'</script>";
        } else {
            echo "<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='register.html'</script>";
        }
    }*/


$obj->fecha_conexao($connect);
?>