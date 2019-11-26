<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">Cadastro Aluno</div>
        <div class="card-body">
            <form method="POST" action="cadastro_aluno_ant.php">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome"
                               required="required" autofocus="autofocus">
                        <label for="Nome:">Nome</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" type="text" name="endereco" id="endereco" class="form-control"
                               placeholder="Endereco" required="required">
                        <label for="Endereço">Endereço</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <select class="custom-select" id="inputGroupSelect01" required="required">
                            <option selected>GCEU</option>
                            <?php
                            // php select option value from database
                                include 'conexao.php';
                                 $connect   = new mysqli('127.0.0.1','root', '', 'wgceu');
                                 $query_select = "SELECT * FROM gceu";
                            //criando a query de consulta à tabela criada
                                $sql = mysqli_query($connect, $query_select) or die(
                                mysqli_error($connect) //caso haja um erro na consulta
                                );

                            //pecorrendo os registros da consulta.
                                while($aux = mysqli_fetch_assoc($sql)) { ?>
                                <option> <?php echo $aux['nome_gceu']; ?> </option>
                                <?php }
                             ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input class="form-control" aria-label="Recipient's username" type="number" min="10" max="120" type="number" name="idade"  id="idade" required="required">
                        <label for="Idade">Idade</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <select class="custom-select"  name="sexo" id="sexo" required="required">
                            <option selected>Sexo</option>
                            <option >Masculino</option>
                            <option >Feminino</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <select class="custom-select"  name="status" id="status" required="required">
                            <option selected>Cargo</option>
                            <option >Membro</option>
                            <option >Visitante</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <select  class="custom-select"  name="apoio" id="apoio" required="required">
                            <option selected>Pode prestar Apoio</option>
                            <option >Habilitado</option>
                            <option >Desabilitado</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit" value="Cadastrar" id="cadastrar" name="cadastrar"
                        >Cadastrar
                </button>
            </form>
            <!--div class="text-center">
                <a class="d-block small mt-3" href="register.html">Voltar a pagina </a>
                <a class="d-block small" href="forgot-password.html">Não lembra a senha ?</a>
            </div-->
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
