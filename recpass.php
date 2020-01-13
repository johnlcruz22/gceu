<?php
include 'conexao.php';

$email        = $_GET['email'];
$senha        = MD5($_POST['senha']);
$obj          = new conexao;
$connect      = $obj->conecta();
$query_select = "select * from recuperacao where utilizador='$email';";
$logarray     = $obj->select($connect, $query_select)['qtde_linhas'];

    if ($logarray <= 0) {
        echo "<script language='javascript' type='text/javascript'>alert('Email não encontrado solicite novamente o Reset.');window.location.href='forgot-password.html';</script>";
        die();
    } else {
        $query = "UPDATE login SET senha ='$senha' WHERE email = '$email';";
        
        $insert = $obj->insert($connect, $query);

        if ($insert==true) {
            $query_delete = "DELETE FROM recuperacao WHERE utilizador ='$email';";
            $delete       = $obj->insert($connect, $query_delete);            
            echo "<script language='javascript' type='text/javascript'>alert('Senha alterada com sucesso!');window.location.href='login.html'</script>";
        } else {
            echo "<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar! Tente novamente.');window.location.href='forgot-password.html'</script>";
        }
    }


$obj->fecha_conexao($connect);
?>