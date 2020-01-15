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
        //Seta mais tempo 10000 segundos
        $_SESSION["sessiontime"] = time() + 10000;
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

  <title>GCEU CONTROL - resumo de presença</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php include('barra_superior.html')?>

  <div id="wrapper">

    <!-- Sidebar -->
      <?php include ('barra_lateral.html')?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tables</li>
        </ol>

        <!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de presença
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>GCEU</th>
                    <th>Tema</th>
                    <th>Data da presença</th>
                    <th>Lider</th>
                    <th>Apoio</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>GCEU</th>
                    <th>Tema</th>
                    <th>Data da presença</th>
                    <th>Lider</th>
                    <th>Apoio</th>
                </tr>
                </tfoot>
                <tbody>

                <?php
                include 'conexao.php';
                $obj            = new conexao;
                $connect1       = $obj->conecta();
                $query_select = "SELECT * FROM lista_presenca;";
                //criando a query de consulta à tabela criada
                $sql = mysqli_query($connect1, $query_select) or die(
                mysqli_error($connect1) //caso haja um erro na consulta
                );
                ?>

                <?php while($aux = mysqli_fetch_assoc($sql)) { ?>
                <tr>
                    <td> <?php echo $aux['aluno'] ?> </td>
                    <td> <?php echo $aux['gceu'] ?> </td>
                    <td> <?php echo $aux['tema'] ?> </td>
                    <td> <?php echo $aux['datapresenca'] ?> </td>
                    <td> <?php echo $aux['professor'] ?> </td>
                    <td> <?php echo $aux['apoio'] ?> </td>

                <?php } ?>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">ultima atualização 00:00:00</div>
</div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
