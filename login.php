<?php
//header("Content-Type: text/html; charset=ISO-8859-1", true);
session_start();
$_SESSION["sessiontime"] = time() + 60;

include 'conexao.php';
$login =  $_POST['email'];
$entrar = $_POST['entrar'];
$senha  = md5($_POST['senha']);
$podelogar = 0;
$obj = new conexao;
$connect = $obj->conecta();


if (isset($entrar)) {
    
    $query_select = "SELECT * FROM login WHERE email = '$login' AND senha = '$senha';" or die("erro ao selecionar");
    
    
    if ($obj->select($connect, $query_select)['qtde_linhas'] <= 0) {
        unset($_SESSION['login']);
        $_SESSION['status'] = '';
        session_abort();
        echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.html';</script>";
        die();
    } else {
        if ($obj->select($connect, $query_select)['array_retornado']['liberado'] > 0) {
            setcookie("login", $login);
            
            $_SESSION['acesso'] = $obj->select($connect, $query_select)['array_retornado']['liberado'];
            $_SESSION['login']  = $login;
            $_SESSION['nome']  = $obj->select($connect, $query_select)['array_retornado']['nome'];
            $_SESSION['status'] = "LOGADO";
            
            echo "<script language='javascript' type='text/javascript'>alert('BEM VINDO ');window.location.href='index.php';</script>";
            header("Location:index.php");
        } else {
            session_abort();
            unset($_SESSION['login']);
            unset($_SESSION['status']);
            unset($_SESSION['acesso']);
            echo "<script language='javascript' type='text/javascript'>alert('Voce nao tem autorizacao suficiente');window.location.href='login.html';</script>";
        }
    }
}
$obj->fecha_conexao($connect);
?>