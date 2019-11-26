<?php
include 'conexao.php';

$_POST['nome'] = isset($_POST['nome']) ? $_POST['nome'] : null;

$gceu           = $_POST['gceu'];
$tema           = $_POST['tema'];
$datatmp        = $_POST['data'];
$apoio          = $_POST['apoio'];
$data           = implode('-', array_reverse(explode('/', $datatmp)));
$professor      = $_POST['professor'];
$obj            = new conexao;
$connect      = $obj->conecta();



if($gceu == "" || $data == "" || $tema == "" || $professor == "" ||
   $gceu == null || $data == null || $tema == null || $professor == null) {

    echo"<script language='javascript' type='text/javascript'>alert('Todos os campos devem ser preenchidos');window.location.href='index.php?idpage=ini';</script>";

}else{
    $query  = "insert into aulas (gceu, tema, datainicio, professor) values ('$gceu',
                                                                             '$tema',         
                                                                             '$data',         
                                                                             '$professor');";

    $insert = $obj->insert($connect,$query);

    if ($_POST['nome']) {
        foreach ($_POST['nome'] as $cadanome) {
            echo "armazenar '$cadanome' </br>";

            $query  = "insert into lista_presenca (aluno, gceu, tema, datapresenca, professor, apoio) values ('$cadanome',
                                                                                                              '$gceu',
                                                                                                              '$tema',         
                                                                                                              '$data',         
                                                                                                              '$professor',
                                                                                                              '$apoio');";

             $insert1 = $obj->insert($connect,$query);
        }
    }else{
        echo "usuário não escolheu nada ('null')";
    }





    if($insert && $insert1){
        echo"<script language='javascript' type='text/javascript'>alert('Aula iniciada,\\nlista de presença gerada abaixo\\nBoa aula a todos! ');window.location.href='index.php?idpage=ini'</script>";
    }else{
        echo"<script language='javascript' type='text/javascript'>alert('Năo foi possível iniciar essa aula');window.location.href='index.php?idpage=ini'</script>";
    }
}

$obj->fecha_conexao($connect);

?>