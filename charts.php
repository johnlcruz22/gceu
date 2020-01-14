<?php
session_start();
/* inicia a sess�o */

if ( isset( $_SESSION["sessiontime"]) or is_null($_SESSION["sessiontime"])) {
    if ($_SESSION["sessiontime"] < time() ) {
        session_unset();
        echo "<script language='javascript' type='text/javascript'>alert('Seu tempo Expirou!');window.location.href='login.html';</script>";
        header("Location: login.html"); // Chamar um form de login por exemplo.
        //Redireciona para login
    } else {
        //Seta mais tempo 60 segundos
        $_SESSION["sessiontime"] = time() + 60;
    }
} else {
    session_unset();
    header("Location: login.html"); // Chamar um form de login por exemplo.
    //Redireciona para login
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />

    <script src='https://api.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.css' rel='stylesheet' />

    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.1/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.1/mapbox-gl-geocoder.css' type='text/css' />

    <title>Graficos uteis</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<?php include('barra_superior.html') ?>

<div id="wrapper">


    <!-- Sidebar -->
    <?php include('barra_lateral.html') ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Métricas</a>
                </li>
                <li class="breadcrumb-item active">Números</li>
            </ol>

            <!-- Area Chart Example-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Quantidade de pessoas por gceu
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="30"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-bar"></i>
                            Quantidade de Gceu/Dias da semanas
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart" width="100%" height="50"></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-pie"></i>
                            Pie Chart Example
                        </div>
                        <div class="card-body">
                            <canvas id="myPieChart" width="100%" height="100"></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-map-marked-alt"></i>
                    Mapa
                </div>
                <div class="card-body" >
                    <!-- MAPA É GERADO AQUI-->
                    <div  class="z-depth-1-half map-container" style="height: 500px" id='map'></div>

                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>


            <p class="small text-center text-muted my-5">
                <em>More chart examples coming soon...</em>
            </p>


        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2019</span>
                </div>
            </div>
        </footer>

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
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
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

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

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
                label: "Nº de Alunos",
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
                    label: "Média de Alunos",
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
<!-- GRAFICO DE BLOCOS-->
<script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    <?php
    //include 'conexao.php';
    $obj      = new conexao;
    $connect1 = $obj->conecta();
    $query_select       = "select diasemana_gceu, count(diasemana_gceu) as qtde from gceu group by diasemana_gceu order by (field(diasemana_gceu,'Segunda-feira','Terca-feira','Quarta-feira','Quinta-feira','Sexta-feira'));";
    $query_select_media = "select count(diasemana_gceu) as qtde1 from gceu group by diasemana_gceu order by qtde1 desc limit 1;";

    $sql = mysqli_query($connect1, $query_select_media) or die(
    mysqli_error($connect1) //caso haja um erro na consulta
    );

    $qtdemax = 0;

    while ($aux1 = mysqli_fetch_assoc($sql)) {
        $qtdemax =  $aux1['qtde1'];
    }


    $sql = mysqli_query($connect1, $query_select) or die(
    mysqli_error($connect1) //caso haja um erro na consulta
    );
    $qtde       = mysqli_num_rows($sql);
    $dia_semana ="";
    $hora       ="";
    while ($aux = mysqli_fetch_assoc($sql)) {

        if ($pcont_label != $qtde) {
            $dia_semana .= '"' . $aux['diasemana_gceu'] . '"' . ",";
            $hora       .= '"' . $aux['qtde'] . '"' . ",";
        } else {
            $dia_semana .= '"' . $aux['diasemana_gceu'] . '"';
            $hora       .= '"' . $aux['qtde'] . '"';
        }
    }
    ?>

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo ($dia_semana)?>],
            datasets: [{
                label: "Quantidade/Dias na semana",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: [<?php echo ($hora)?>],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 10
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: <?php echo ($qtdemax)?>,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });

</script>
<!-- GRAFICO DE PIZZA-->
<script src="js/demo/chart-pie-demo.js"></script>




<!-- MAPA -->

<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoiam9obmxjcnV6MjIiLCJhIjoiY2swczQ5azZjMDU4bTNtbnhnaWIyZjh1biJ9.dMjg8smievnyZ-D86AB6CQ';
      var map = new mapboxgl.Map
	  ({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-46.89, -23.607],
        zoom: 12
	  })
		 map.addControl(new MapboxGeocoder
		 ({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
		 }));

	map.on('load', function()
	{
		map.loadImage("https://img.icons8.com/dusk/64/000000/family.png", function(error, image)
		{
			if (error) throw error;
			map.addImage('gceu', image);
			map.addLayer
			({
					"id": "points",
					"type": "symbol",
					"source":
			        {
					  "type": "geojson",
					  "data":
					  {
						 "type": "FeatureCollection",
						 "features":
						 [

    <?php
        //include 'conexao.php';
        $obj      = new conexao;
        $connect1 = $obj->conecta();
        $query_select_gceu  = "select * from gceu;";

        $sql = mysqli_query($connect1, $query_select_gceu) or die(
        mysqli_error($connect1) //caso haja um erro na consulta
        );
        
        $qtde       = mysqli_num_rows($sql);
        $nomedogceu ="";
        $hora       ="";
        $controlault=0;
        
        while ($aux = mysqli_fetch_assoc($sql)) {
         
         if ($controlault != $qtde){
          echo '
                           {
                            "type": "Feature",
                            "geometry":
                            {
                                "type": "Point",
                                "coordinates": [' .$aux['latlong']. ']
                            },
                            "properties": {
                            "title": "' .$aux['nome_gceu']. '",
                            "icon": "gceu"
                           }
                           },
                ';           
         }else{
          echo '
                           {
                            "type": "Feature",
                            "geometry":
                            {
                                "type": "Point",
                                "coordinates": [' .$aux['latlong']. ']
                            },
                            "properties": {
                            "title": "' .$aux['nome_gceu']. '",
                            "icon": "gceu"
                           }
                           }
                ';           
         }

      
        }
      ?>                         
                     ]
                      }
                    },"layout": 
  				    {
			    	 "icon-size": 0.75,
					 // get the icon name from the source's "icon" property
					 // concatenate the name to get an icon from the style's sprite sheet
					 "icon-image": "gceu",
					 // get the title name from the source's "title" property
					 "text-field": ["get", "title"],
					 "text-font": ["Open Sans Semibold", "Arial Unicode MS Bold"],
					 "text-offset": [0, 0.6],
					 "text-anchor": "top"
			        }
            });
	    });
    });
</script>



</body>

</html>