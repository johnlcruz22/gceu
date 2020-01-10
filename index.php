<?php
session_start();
/* inicia a sessão */

//var_dump($_SESSION['sessiontime']);

if ( isset( $_SESSION["sessiontime"]) or is_null($_SESSION["sessiontime"])) {
    if ($_SESSION["sessiontime"] < time() ) {
        session_unset();
        echo "<script language='javascript' type='text/javascript'>alert('Seu tempo Expirou!');window.location.href='login.html';</script>";
        header("Location: login.html"); // Chamar um form de login por exemplo.
        $idUsuario = $_SESSION['login'];
        //Redireciona para login
    } else {
        //Seta mais tempo 60 segundos
        $_SESSION["sessiontime"] = time() + 600;
         $idUsuario = $_SESSION['login'];
    }
} else {
    session_unset();
    header("Location: login.html"); // Chamar um form de login por exemplo.
    //Redireciona para login
}


?>
<!DOCTYPE html>
<html lang='pt-BR'>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estáticas GCEU</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">


</head>
<body id="page-top">

    <?php include('barra_superior.html');?>

<div id="wrapper">

    <?php

    if ($_SESSION['acesso'] == 3){
        include ('barra_lateral.html');
    }else{
        include ('barra_lateral_'.$_SESSION['acesso'].'.html');
    }
    ?>

    <div id="content-wrapper">

     <?php   //CONTROLA CORPO DA APLICACAO
           $iddolink  = '';
           $iddolink  = $_GET['idpage'];

            switch ($iddolink) {
                case "alu":
                    include ('cadastro_aluno.html');
                    break;
                case "gce":
                    include ('cadastrar_novo_gceu.html');
                    break;
                case "igr":
                    include ('cadastrar_igreja.html');
                    break;
                case "duv":
                    include ('cadastrar_duvidas.html');
                    break;
                case "ini":
                    include ('iniciar_aula.html');
                    break;
                case "aut":
                    include ('autorizacao.html');
                    break;
                default:
                    include ('corpo_'.$_SESSION['acesso'].'.html');
             }
     ?>
        
        <!-- Sticky Footer 
        <footer class="footer mt-auto py-3">
            <div class="container my-auto navbar-fixed-bottom">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2019</span>
                </div>
            </div>
        </footer>
        -->



    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

       

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmar saída.</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Realmente deseja sair ?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="login.html">Sair</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- ESSE E ORIGINAL JOHN PARA CUIDAR DO MAPA-->
<script src="carrega_endereco.js"></script> 
<script src="location.js"></script>

<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>
<!--script src="js/demo/chart-area-demo.js"></script>
<!-- GRAFICO DE LINHAS-->
<script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    <?php
    include 'conexao.php';
    $obj = new conexao;
    $connect1 = $obj->conecta();
    $query_select       = "select nome_gceu, (select count(nome) from aluno where nome_gceu = gceu) as qtde_alunos, (select AVG(distinct((select count(nome) from aluno where nome_gceu = gceu))) from gceu) as media from gceu;";
    //$query_select_media = "select AVG(distinct((select count(nome) from aluno where nome_gceu = gceu))) as media from gceu;";

    $sql = mysqli_query($connect1, $query_select) or die(
    mysqli_error($connect1) //caso haja um erro na consulta
    );
    $media_calc    = 0;
    $pcont_label   = 1;
    $label_virgula ="";
    $data_virgula  ="";
    $media_virgula ="";
    $qtde          = mysqli_num_rows($sql);

    while ($aux = mysqli_fetch_assoc($sql)) {

    if($pcont_label!=$qtde){
     $label_virgula .= '"'.$aux['nome_gceu'].'"'.",";
     $data_virgula  .= '"'.$aux['qtde_alunos'].'"'.",";
    }else{
     $label_virgula .= '"'.$aux['nome_gceu'].'"';
     $data_virgula  .= '"'.$aux['qtde_alunos'].'"';
     $media12        =     $aux['media'];
    }

     ?>
     eval("jcont_label_"+<?php echo $pcont_label;?> + "= '<?php echo $aux['nome_gceu']?>';");
    <?php $pcont_label++;}

    $teste = implode(',', array_fill(0, $qtde, '"'.$media12.'"'));

    ?>

    //alert(<?php echo ($teste)?>);

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $label_virgula;?>],
            datasets: [{
                label: "NÂº de Alunos",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 4,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 7,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [<?php echo $data_virgula;?>],
            },
                {
                    labels: [<?php echo $label_virgula;?>],
                    label: "MÃ©dia de Alunos",
                    lineTension: 0,
                    backgroundColor: "rgba(2,2,216,0.2)",
                    borderColor: "rgba(2,2,216,1)",
                    pointRadius: 4,
                    pointBackgroundColor: "rgba(2,2,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data:[<?php echo ($teste)?>],

                }
            ],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: <?php echo $qtde; $obj->fecha_conexao($connect1) ?>,
                        maxTicksLimit: 7
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: true
            }
        }
    });

</script>

</body>

</html>
